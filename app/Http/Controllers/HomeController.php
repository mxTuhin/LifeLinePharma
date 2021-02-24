<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\View\ViewFinderInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest:admin');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        if(Auth::guard('admin')->check()){
            return view('Admin.dashboard');
        }
        else{
            return redirect()->to('admin');
        }
    }

    public function profile(){


        if(Auth::guard('admin')->check()){
            return view('Admin.profile',[
                "user"=>Auth::guard('admin')->user()
            ]);
        }
        else{
            return redirect()->to('admin');
        }

    }

    public function placeOrder()
    {
        if(Auth::guard('admin')->check()){
            $idArray = \Cart::session(Auth::guard('admin')->id())->getContent();
            $idArray=$idArray->sort();
            return view('Admin.placeOrder',[
                'cartProds'=>Product::whereIn('id', $idArray->pluck('id'))->get(),

                'cartQTY'=>$idArray->pluck('quantity'),
            ]);
        }
        else{
            return redirect()->to('admin');
        }
    }

    public function addProduct()
    {

        if(Auth::guard('admin')->check()){
            return view('Admin.addProduct',[
                'category'=>DB::table('category')->get(['name'])
            ]);
        }
        else{
            return redirect()->to('admin');
        }
    }

    public function  productList(){

        if(Auth::guard('admin')->check()){
            return view('Admin.productList',[
                "products"=>DB::table('products')->where('status','=' ,'active')->paginate(16)->onEachSide(0),
                "disPro"=>DB::table('products')->where('status', '=', 'disable')->get() ,
                'category'=>DB::table('category')->get(['name'])
            ]);
        }

        else{
            return redirect()->to('admin');
        }
}

    public function search(Request $request){
        $output="";
        if($request->ajax() && $request->search !=""){

            $products=DB::table('products')->where('name', 'LIKE', '%'.$request->search."%")->limit(8)->get();
            if($products){
                $i=0;
                foreach ($products as $product){
    //                    $output.='<tr>'.
    //                        '<td>'.$i.'</td>'.
    //                        '<td>'.$product->name.'</td>'.
    //                        '<td>'.$product->category.'</td>'.
    //                        '<td>'.round($product->price, 2).'</td>'.
    //                        '</tr>';


                    $output.='<div onclick="productModal(\'../assets/products/\', 
                    \' '.$product->name.'  \',
                    \''.$product->category.'\',
                    \''.$product->quantity.'\',
                    \''.round($product->price, 2).'\',
                    \''.$product->img.'\',
                    \''.$product->status.'\',
                    \''.$product->id.'\',
                    \''.$product->dealer_price.'\'
                    )"
                     data-toggle="modal" data-target="#productModal" class="col-12 col-sm-3 clickable hoverCard">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <div class="row">
                                <p class="card-title col-6 col-sm-6">'.$product->name.'</p>
                                <p class="card-title col-6 col-sm-6">In Stock: '.$product->quantity.'</p>
                            </div>
                                <div class="row">
                                    <p style="font-size: 18px" class="card-category col-6 col-sm-6"><b>BDT: '.round($product->price, 2).'</b></p>
                                    <p  class="card-category col-6 col-sm-6"><b>Category: '.$product->category.'</b></p>
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
                $output.='<p class="text-danger">No Products With Such Name</p>';
            }
        }
        return Response ($output);
    }

    public function setSessionLight(Request $request){
        $name=Auth::guard('admin')->user()->username;

        Storage::put($name.'.json',$request->mode);
    }

    public function getSession(){
        $name=Auth::guard('admin')->user()->username;
        return Storage::get($name.'.json');
    }

    public function updateProduct(){
        if(Auth::guard('admin')->check()){
            return view('Admin.updateProduct',[
                "products"=>DB::table('products')->where('status','=' ,'active')->paginate(16)->onEachSide(1)
            ]);
        }
        else{
            return redirect()->to('admin');
        }
    }




}
