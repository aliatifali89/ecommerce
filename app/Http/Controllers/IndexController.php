<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;
class IndexController extends Controller
{
    public function index(){
        $ProductAll=Product::orderBy('id','DESC')->where(['status'=>1])->get();
         //echo "<pre>";print_r($ProductAll);die; 
        //for random order
       // $ProductAll=Product::inRandomOrder()->get();
        
        $categories=Category::with('categories2')->where(['parent_id'=>0])->get(); //before it was showing clothes and shoes only
//        $category=json_decode(json_encode($category));
//          echo "<pre>";print_r($category);die;   
        $categories_menu="";
//        foreach($category as $cat){
//           
//            		
//				$categories_menu.="<div class='panel-heading'>
//									<h4 class='panel-title'>
//										<a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
//											<span class='badge pull-right'><i class='fa fa-plus'></i></span>
//											".$cat->name."
//										</a>
//									</h4>
//								</div>
//                    
//                    <div id='".$cat->id."' class='panel-collapse collapse'>
//									<div class='panel-body'>
//										<ul>";
//                                         $subcategory=Category::where(['parent_id'=>$cat->id])->get();
//                                    // echo "<pre>";print_r($subcategory);die;     
//                                        foreach($subcategory as $scat){
//                                            
//                                          $categories_menu.="<li><a href='".$scat->url."'>".$scat->name." </a></li>";
//
//                                            }
//											
//										$categories_menu.="</ul>
//									</div>
//								</div>";
//            
//            
//           
//        } //for normal approach without relation
        
        //Banners
        $banners=Banner::where('status',1)->get();
        //dd($banners);
        return view('index')->with(compact('ProductAll','categories_menu','categories','banners'));
    }
}
