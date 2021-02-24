<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    public function store(){
        $this->validate(\request(),[
            'productName'=>'required',
            'category'=>'required',
            'unitPrice'=>'required',
            'dealer_price'=>'required'
        ]);
        $input=\request()->all();

        if(\request()->hasFile('image')){
            $image = \request()->file('image');
            $new_name = Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/products'), $new_name);
        }

        try{
            $product =new Product;


            $product->name=$input['productName'];
            $product->category=$input['category'];
            $product->dealer_price=$input['dealer_price'];
            $product->price=$input['unitPrice'];
            $product->quantity=$input['quantity'];
            $product->img=$new_name;
            $product->status="active";

            $product->save();
            $prodID=DB::table('products')->where('img','=',$new_name)->first();
            $this->addStock($prodID, $input['quantity']);
        }
        catch (\Throwable $e){
            return abort(404, '702');
        }



        return redirect()->to(route('addProduct'));
    }


    public function edit(){
        $this->validate(\request(),[
            'productName'=>'required',
            'category'=>'required',
            'unitPrice'=>'required',
            'dealer_price'=>'required'
        ]);
        $input=\request()->all();
        $new_name="";

        if(\request()->hasFile('image')){
            $image = \request()->file('image');
            $new_name = Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/assets/products'), $new_name);
        }


        try {
            $product = Product::find($input['productID']);

            $product->name = $input['productName'];
            $product->category = $input['category'];
            $product->quantity = $product->quantity+$input['quantity'];
            $product->dealer_price=$input['dealer_price'];
            $product->price = $input['unitPrice'];
            $product->status = $input['status'];
            if($new_name!=""){
                $product->img=$new_name;
            }


            $product->save();
            if($input['status']!='disable' && $input['quantity']!=0){
                $this->addStock($input['productID'], $input['quantity']);
            }

        }
        catch (\Exception $e){
            return abort(404, '702');
        }

        return redirect()->to(route('productsList'));

    }






    public function cartSearchBlock(Request $request){
        $output="";
        if($request->ajax() && $request->search !=""){

            $products=DB::table('products')->where('name', 'LIKE', '%'.$request->search."%")->limit(8)->get();
            if($products){
                $i=0;
                foreach ($products as $product){
                    $output.='<div onclick="addNode(\'../assets/products/\', 
                    \' '.$product->name.'  \',
                    \''.$product->category.'\',
                    \''.round($product->price, 2).'\',
                    \''.$product->img.'\',
                    \''.$product->id.'\',
                    \''.$product->quantity.'\'
                    )"
                     class="col-12 col-sm-3 clickable hoverCard">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="row">
                                <p id="cartProductName'.$product->id.'" class="card-title col-6 col-sm-6">'.$product->name.'</p>
                                <p id="cartQuantity'.$product->id.'" class="card-title col-6 col-sm-6">In Stock: '.$product->quantity.'</p>
                            </div>
                                <div class="row">
                                    <h4 id="cartPrice'.$product->id.'" class="card-category col-6 col-sm-6"><b>BDT: '.round($product->price, 2).'</b></h4>
                                    <h6 class="card-category col-6 col-sm-6"><b>Category: '.$product->category.'</b></h6>
                                </div>
    
                            </div>
                            <div align="center" class="card-body table-responsive">
                                <img class="img-fluid" style="height: 300px" src="../assets/products/'.$product->img.'">
    
                            </div>
                        </div>
                    </div>';

                    $i++;

                }
            }
            if($i==0){
                $output.='<p class="text-danger">No Products Available</p>';
            }
        }
        return Response ($output);
    }


    public function addCategory(){
        $this->validate(\request(),[
            'categoryName'=>'required',
        ]);
        $input=\request()->all();

        try{
            DB::table('category')->insert([
                'name'=>$input['categoryName']
            ]);
        }
        catch (\Exception $e){

        }

        return redirect()->to(route('addProduct'));

    }

    public function enableProduct(Request $request){
        if($request->ajax() && $request->id !="") {
            $product = Product::find($request->id);

            $product->status='active';
            $product->save();

        }
        return 'success';
    }

    public function generateStatement(Request $request){
        Session([
            'preDate'=>$request->preDate,
            'postDate'=>$request->postDate,
        ]);
//        return Session::get('preDate')." ".Session::get('postDate');
    }
    public function generateSalesAndStock(Request $request){
        Session([
            'preDate'=>$request->preDate,
            'postDate'=>$request->postDate,
        ]);
//        return Session::get('preDate')." ".Session::get('postDate');
    }

    public function statementView(){
        if(Auth::guard('admin')->check()){
//            ddd();
            $inv=DB::table('invoice')->whereBetween('date',[Session::get('preDate'), Session::get('postDate')])->orderBy('date', 'asc')->get();


            return view('Admin.statement',[
                'inv'=>$inv
            ]);
        }
        else{
            return redirect()->to('admin');
        }
    }

    public function ssView(){
        if(Auth::guard('admin')->check()){
            $preDate=Session::get('preDate');
            $postDate=Session::get('postDate');
            $inv=DB::select("select id, date, productName as name, price, quantity, 'Sales' as tag, updated_at from sales where date between '$preDate' and '$postDate' UNION ALL SELECT id, date, name, dealer_price, quantity, 'Stock' as tag, updated_at from stock where date between '$preDate' and '$postDate' order by date, updated_at ");
//            ddd($inv);
            return view('Admin.salesAndStock',[
                'inv'=>$inv
            ]);
        }
        else{
            return redirect()->to('admin');
        }
    }

    public function updateSearch(Request $request){
        $output="";
        if($request->ajax() && $request->search !=""){

            $products=DB::table('products')->where('name', 'LIKE', '%'.$request->search."%")->limit(8)->get();
            if($products){
                $i=0;
                foreach ($products as $item){
                    ?>
                    <tr>
                        <td scope="row">
                            <input onchange="onChangeField('<?php echo $item->id ?>', 'name')" style="width: 350px" type="text"
                                   class="form-control" placeholder="Dealer Price"
                                   value="<?php echo $item->name ?>"
                                   id="name<?php echo $item->id ?>">

                        </td>
                        <td><div align="center"><?php echo $item->category ?></div></td>
                        <td>
                            <div align="center">
                                <input onchange="onChangeField('<?php echo $item->id ?>', 'dealer_price')" style="width: 100px" type="number"
                                       class="form-control" placeholder="Dealer Price"
                                       value="<?php echo $item->dealer_price ?>"
                                       id="dealer_price<?php echo $item->id ?>">
                            </div>
                        </td>

                        <td>
                            <div align="center">
                                <input onchange="onChangeField('<?php echo $item->id ?>', 'price')" style="width: 100px" type="number"
                                       class="form-control" placeholder="Retail Price"
                                       value="<?php echo $item->price ?>"
                                       id="price<?php echo $item->id ?>">
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <div style="width: 250px" class="row">
                                    <div class="col-6 col-sm-6">
                                        <span style="font-size: 14px">In Stock: <span style="color: whitesmoke;" id="qty<?php echo $item->id ?>"><?php echo $item->quantity ?></span></span>
                                    </div>
                                    <div class="col-6 col-sm-6">
                                            <span>
                                                    <input onchange="onChangeField('<?php echo $item->id ?>', 'quantity')" style="width: 100px" type="number"
                                                           class="form-control" placeholder="Add Stock"
                                                           value=""
                                                           id="quantity<?php echo $item->id ?>">
                                            </span>
                                    </div>



                                </div>

                            </div>
                        </td>
                    </tr>
<?php


                    $i++;

                }
            }
            if($i==0){
                $output.='<p class="text-danger">No Products With Such Name</p>';
            }
        }
        return Response ($output);
    }

    public function batchUpdate(Request $request)
    {

        if ($request->ajax() && $request->rowID != "") {
            $product = Product::find($request->rowID);
            if($request->column=="dealer_price"){
                $product->dealer_price =$request->instance;
            }
            else if($request->column=="price"){
                $product->price =$request->instance;
            }
            else if($request->column=="quantity"){
                $product->quantity =$product->quantity+ $request->instance;
                $this->addStock($request->rowID, $request->instance);
            }
            else if($request->column=="name"){
                $product->name =$request->instance;
            }
            $product->save();
            return $product;
        }
    }

    public function addStock($id, $quantity){
        $product=Product::find($id);
        DB::table('stock')->insert([
           'date'=>date('Y-m-d'),
           'name'=>$product->name,
           'quantity'=>$quantity,
           'dealer_price'=>$product->dealer_price
        ]);

    }










}
