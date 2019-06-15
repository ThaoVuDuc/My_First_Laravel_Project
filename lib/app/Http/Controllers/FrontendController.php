<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;


class FrontendController extends Controller
{
    public function getHome(){
    	$data['featured'] = Product::where('prod_featured', 1)->orderBy('prod_id', 'desc')->get();
    	$data['news'] = Product::orderBy('created_at', 'desc')->get();
    	return view('frontend.home', $data);
    }
    public function getDetail($id){
    	$data['item'] = Product::find($id);
    	$data['comments'] = Comment::where('com_product', $id)->get();
    	return view('frontend.details', $data);
    }
    public function postComment(Request $request, $id){
    	$comment = new Comment;
    	$comment->com_email = $request->email;
    	$comment->com_name = $request->name;
    	$comment->com_content = $request->content;
    	$comment->com_product = $id;
    	$comment->save();
    	return back();
    }
    public function getCategory($id){
    	$data['cateName'] = Category::find($id);
    	$data['product_cate'] = Product::where('prod_cate', $id)->orderBy('prod_id', 'desc')->paginate(1);
    	return view('frontend.category', $data);
    }
    public function getSearch(Request $request){
    	$keyWord = $request->result;
    	$data['keyword'] = $keyWord;
    	$keyWord = str_replace(' ', '%', $keyWord);// thay các ký tự khoảng trắng bằng ký tự %
    	$data['product_found'] = Product::where('prod_name', 'like', '%'.$keyWord.'%')->get();
    	return view('frontend.search', $data);
    }
    public function getComplete(){
        return view('frontend.complete');
    }
}
