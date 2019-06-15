<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;
use Mail;

class CartController extends Controller
{
    //
    public function getAddCart($id){
    	$product = Product::find($id);
    	Cart::add(array('id' => $id, 'name' => $product->prod_name, 'quantity' => 1, 'price' => $product->prod_price, 'attributes' => array('img' => $product->prod_img)) );
    	return redirect('cart/show');
    }
    public function getShowCart(){
    	$data['items'] = Cart::getContent();
    	$data['total'] = Cart::getTotal();
    	return view('frontend.cart', $data);
    }
    public function getDeleteCart($id){
    	if($id == 'all')
    	{
    		//xóa hết giỏ hàng
    		Cart::clear();
    	}else{
    		//xóa một hàng
    		Cart::remove($id);
    	}
    	return back();
    }
    public function getUpdateCart(Request $request){
        $data['quantity'] =json_decode($request->quantity);
        //$data = json_decode($data, true);
        Cart::update($request->id, $data);
    }
    public function postComplete(Request $request){
        $data['infor'] = $request->all();
        $data['cart'] = Cart::getContent();
        $data['total'] = Cart::getTotal();
        $email = $request->email;
        $name = $request->name;
        Mail::send('frontend.email', $data, function ($message) use ($email, $name) {
            $message->from('vuducthao2210@gmail.com', 'Thao Vu Duc');        
            $message->to($email, $email);
        
            $message->cc('vdthao2210@gmail.com', 'Thao Vu');  
        
            $message->subject('Xác nhận hóa đơn mua hàng !');
        
        });
        Cart::clear();
        return redirect('complete');
    }

}
