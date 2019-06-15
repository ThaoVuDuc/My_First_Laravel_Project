<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\AddProductRequest;
use DB;

class ProductController extends Controller
{
    //
    public function getProduct(){
    	$data['productlist'] = DB::table('products')->join('categories', 'products.prod_cate','=', 'categories.cate_id')->orderBy('prod_id', 'desc')->get();
    	return view('backend.product', $data);
    }
    public function getAddProduct(){
    	$data['catelist'] = Category::all();
    	return view('backend.addproduct', $data);
    }
    public function PostAddProduct(AddProductRequest $request){
    	$product = new Product;
    	$filename = $request->img->getClientOriginalName();//lấy tên ảnh
    	$product->prod_name = $request->name;
    	$product->prod_slug = str_slug($request->name);
    	$product->prod_price = $request->price;
    	$product->prod_img = $filename;
    	$product->prod_accessories = $request->accessories;
    	$product->prod_warranty = $request->warranty;
    	$product->prod_promotion = $request->promotion;
    	$product->prod_condition = $request->condition;
    	$product->prod_status = $request->status;
    	$product->prod_description = $request->description;
    	$product->prod_cate = $request->cate;
    	$product->prod_featured = $request->featured;
    	$product->save();
    	$request->img->storeAs('avatar', $filename);//hàm lưu ảnh vào trong thư mục avatar ở trong storage
    	return redirect('admin/product');
    }
    public function getEditProduct($id){
    	$data['product'] = Product::find($id);
        $data['catelist'] = Category::all();
    	return view('backend.editproduct', $data);
    }
    public function postEditProduct(Request $request, $id){
    	   $product = new Product;
           $data = [
                'prod_name' => $request->name,
                'prod_slug' => str_slug($request->name),
                'prod_price' => $request->price,
                'prod_accessories' => $request->accessories,
                'prod_warranty' => $request->warranty,
                'prod_promotion' => $request->promotion,
                'prod_condition' => $request->condition,
                'prod_status' => $request->status,
                'prod_description' => $request->description,
                'prod_cate' => $request->cate,
                'prod_featured' => $request->featured
           ];
           if($request->hasFile('img')){
            $img = $request->img->getClientOriginalName();
            $data['prod_img'] = $img;
            $request->img->storeAs('avatar', $img);
           }
           $product::where('prod_id', $id)->update($data);
           return redirect('admin/product');
    }
    public function getDeleteProduct($id){
        Product::destroy($id);
        return back();    	
    }
}
