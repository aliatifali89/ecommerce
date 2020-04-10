<?php

namespace App\Http\Controllers;
use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
 public function addCategory(Request $request){
    if($request->isMethod('post')){
        $data=$request->all(); //this is form data
     //echo "<pre>";print_r($data);die;
        if(empty($data['status'])){
            $status=0;
        }else{
             $status=1;
        }
        $category=new Category;
        $category->name=$data['name'];
        $category->parent_id=$data['parent_id'];
        $category->description=$data['description'];
        $category->url=$data['url'];
        $category->status=$status;
        $category->save();
        return redirect('/admin/view-categories')->with('flash_message_success','added successfully'); ;
    }
     $level = Category::where(['parent_id'=> 0])->get();
     return view('admin.categories.add_category')->with(compact('level'));
 }
    
    
public function viewCategories(Request $request){
    
        $categories=Category::get(); //this is table data
        return view('admin.categories.view_categories')->with(compact('categories'));
} 
    
    
public function editCategory(Request $request,$id=null){
         if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
               if(empty($data['enable'])){
                    $status=0;
                }else{
                     $status=1;
                }
           Category::where(['id'=>$id])->update(
               [
                   'name'=>$data['name'],
                   'description'=>$data['description'],
                   'url'=>$data['url'],
                   'status'=>$status
               ]
           );
             return redirect('/admin/view-categories')->with('flash_message_success','category updated');
        }
        $category_details=Category::where(['id'=>$id])->first();
        $level_details=Category::where(['parent_id'=>0])->get();
        return view('admin.categories.edit_category')->with(compact('category_details','level_details'));
} 
    
    
public function deleteCategory($id=null){
        Category::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','category deleted');
} 
}
