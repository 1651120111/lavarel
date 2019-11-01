<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;


class FrontendController extends Controller
{

    public function getHome(){
    	$data['featured'] = Product::where('pro_featured',1)->orderBy('pro_id','ASC')->take(8)->get();
    	$data['news'] = Product::orderBy('pro_id','desc')->take(8)->get();
    	return view('frontend.home',$data	);
    }
    public function getDetail($id){
    	$data['items'] = Product::find($id);
    	$data['comments'] = Comment::where('com_product' ,$id)->get();
    	return view('frontend.details',$data);
    }
    public function getCategory($id){
    	$data['cateName'] = Category::find($id);
    	$data['items'] = Product::where('pro_cate',$id)->orderBy('pro_id','desc')->paginate(2);
    	return view('frontend.category',$data);
    }
    public function postComment($id,Request $request){
    	$comments = new Comment;
    	$comments->com_name = $request->name;
    	$comments->com_email = $request->email;
    	$comments->com_content = $request->content;
    	$comments->com_product = $id;
    	$comments->save();
    	return back();
    }
    public function getSearch(Request $request){
    	$result= $request->result;
    	$data['cateName'] = $result;
    	$result= str_replace(' ','%',$result);
    	
    	$data['items'] = Product::where('pro_name','like','%'.$result.'%')->paginate(8);
    	return view('frontend.search',$data);
    }
   
}
