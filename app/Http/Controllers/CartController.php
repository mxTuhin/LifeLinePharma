<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\Exceptions\InvalidConditionException;
use Darryldecode\Cart\Exceptions\InvalidItemException;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;

class CartController extends Controller
{
    public $customerName, $customerCellnum;
    //
    public function addToCart(Request $request){
        $flag=false;
        $reponse=array();
        $reponse['status']="null";

        if($request->ajax() && $request->rowID !=""){
            $idArray = \Cart::session(Auth::guard('admin')->id())->getContent();
            $idArray=$idArray->pluck('id');
            foreach($idArray as $i){
                if($i==$request->rowID){
                    $flag=true;
                    break;
                }
            }
            if($flag){
                $reponse['status']="notValidate";
            }
            else{
                \Cart::session(Auth::guard('admin')->id())->add(array(
                    'id' => $request->rowID,
                    'name' => $request->prodName,
                    'price' => $request->prodPrice,
                    'quantity' => 1,
                    'associatedModel'=>Product::find($request->rowID)
                ));
            }


        }
        $reponse['total']=$this->getSubTotal();
        return Response($reponse);
    }

    public function removeFromCart(Request $request){
        if($request->ajax() && $request->rowID !=""){
            \Cart::session(Auth::guard('admin')->id())->remove($request->rowID);

        }
    }

    public function showCart(){
        return Response(\Cart::session(Auth::guard('admin')->id())->getContent());

    }

    public function clearCart(){

        \Cart::session(Auth::guard('admin')->id())->clear();
    }

    public function updateCartQuantity(Request $request){
        if($request->ajax() && $request->rowID !=""){
            \Cart::session(Auth::guard('admin')->id())->update($request->rowID, array(
                'quantity'=>$request->qty
            ));
        }


    }

    public function replaceCartQuantity(Request $request){
        if($request->ajax() && $request->rowID !=""){
            \Cart::session(Auth::guard('admin')->id())->update($request->rowID, array(
                'quantity'=>array(
                    'relative'=>false,
                    'value'=>$request->qty
                ),
            ));
        }

    }

    public function getCartTotal(){
        $response=array();
        $response['disStatus']="";
        $total=\Cart::session(Auth::guard('admin')->id())->getTotal();
        $subTotal = \Cart::session(Auth::guard('admin')->id())->getSubTotal();
        if($total<$subTotal){
            $response['disStatus']=" (Discount Applied)";
        }
        $response['total']=$total;
        return Response($response);
    }

    public function getSubTotal(){
        return \Cart::session(Auth::guard('admin')->id())->getSubTotal();
    }



    public function cartDiscount(Request $request){
        $exCon = $cartConditions = \Cart::session(Auth::guard('admin')->id())->getConditions();
        if(count($exCon)<=0){
            try {
                $condition = new \Darryldecode\Cart\CartCondition(array(
                    'name' => $request->value,
                    'type' => 'discount',
                    'target' => 'total',
                    'value' => '-'.$request->value,
                    'order'=>'1'
                ));
                \Cart::session(Auth::guard('admin')->id())->condition($condition);
            } catch (InvalidConditionException $e) {
                return "twoe";
            }
        }

    }

    public function clearCartCondition(){
        \Cart::session(Auth::guard('admin')->id())->clearCartConditions();
    }

    public function checkout(Request $request){
        $response=array();
        $total=\Cart::session(Auth::guard('admin')->id())->getTotal();
        $subTotal=\Cart::session(Auth::guard('admin')->id())->getSubTotal();
        if($request->ajax()){
            $product_cost=0;
            $saleIdentifier=Str::random(10);
            Session([
                'saleIdentifier'=>$saleIdentifier,
            ]);
            $items = \Cart::session(Auth::guard('admin')->id())->getContent();
            foreach($items as $row) {
                $product=Product::find($row->id);
                $product->quantity = $product->quantity-$row->quantity;
                $product->save();
                $product_cost+=($product->dealer_price*$row->quantity);
                DB::table('sales')->insert([
                    'saleIdentifier'=>$saleIdentifier,
                    'seller'=>Auth::guard('admin')->user()->firstname,
                    'productName'=>$row->name,
                    'quantity'=>$row->quantity,
                    'dealer_price'=>$product->dealer_price,
                    'price'=>$row->price,
                    'customerName'=>$request->name,
                    'cellnum'=>$request->cellnum,
                    'date'=>date('Y-m-d'),
                    'category'=>$row->associatedModel->category,
                ]);
            }
            DB::table('invoice')->insert([
                'identifier'=>$saleIdentifier,
                'seller'=>Auth::guard('admin')->user()->firstname,
                'customername'=>$request->name,
                'cellnum'=>$request->cellnum,
                'product_cost'=>$product_cost,
                'subtotal'=>$subTotal,
                'discount'=>$subTotal-$total,
                'total'=>floor($total),
                'date'=>date('Y-m-d')
            ]);

        }
        $response['status']=true;
        $response['name']=$request->name;
        $response['cellnum']=$request->cellnum;
        Session([
            'customerName'=>$request->name,
            'customerCellnum'=>$request->cellnum
        ]);


        return Response($response);
    }

    public function invoice(){
        if(Auth::guard('admin')->check()){
            return view('Admin.invoice',[
                'invCount'=>DB::table('invoice'),
                'cart'=>\Cart::session(Auth::guard('admin')->id()),
                'customerName'=>$this->customerName,
                'customerCellnum'=>$this->customerCellnum
            ]);

        }
        else{
            return redirect()->to('admin');
        }
    }

    public function generateInv(Request $request){

        if(Auth::guard('admin')->check()){
            $inv="";
            $invS="";
            try{
                $inv=DB::table('invoice')->where('id',$request->invNo)->first();
                $invS=DB::table('sales')->where('saleIdentifier', $inv->identifier)->get();
            }catch (\Exception $e){
                return abort(404, '704');
            }

            return view('Admin.invoiceDB',[
                'inv'=>$inv,
                'invS'=>$invS,
                'cart'=>\Cart::session(Auth::guard('admin')->id()),
                'customerName'=>$this->customerName,
                'customerCellnum'=>$this->customerCellnum
            ]);

        }
        else{
            return redirect()->to('admin');
        }
    }

    public function initiateCartClearance(){
        $this->clearCartCondition();
        $this->clearCart();
    }

    public function updateInv(Request $request){
        if($request->ajax()){
            $task=DB::update("UPDATE invoice SET tax='$request->value' WHERE identifier='$request->saleIdentifier'");

        }

    }




}
