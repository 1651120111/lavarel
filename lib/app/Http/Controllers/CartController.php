<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use Mail;

class CartController extends Controller
{
     public function getAddCart($id){
     	$product = Product::find($id);
    	Cart::add(['id' => $id, 'name' => $product->pro_name, 'qty' => 1, 'price' => $product->pro_price, 'options' => ['img' => $product->pro_img]]);

    	return redirect('cart/show');
    }
    public function getShowCart(){
    	$data['totals'] = Cart::total(0,',','.');
    	$data['items'] = Cart::content();

    	return view('frontend.cart',$data);
    }
    public function getDeleteCart($id){
    	if($id == 'all'){
    		Cart::destroy();

    	}else{
    	
    		Cart::remove($id);
    	}
    	return back();
    }
    public function getUpdateCart(Request $request){
    	Cart::update($request->rowId,$request->qty);
    }
    public function postComplete(Request $request){
    	$data['info'] = $request->all();
    	$email = $request->email;
    	$data['totals'] = Cart::total(0,',','.');
   		$data['carts']  = Cart::content();

    	Mail::send('frontend.email', $data, function ($message) use ($email) {
    	    $message->from('runhitbtn2@gmail.com', 'Thiện Nhân');
    		 
    	    $message->to($email, $email);
    	
    	    $message->cc('thiennhan677@gmaiml.com', 'Nhân');	
    	    $message->subject('Xác nhận hóa đơn mua hàng');
  
    	});
    	Cart::destroy();
    	return redirect('complete');
    }
    public function getComplete(){
    	return view('frontend.complete');
    }
}
