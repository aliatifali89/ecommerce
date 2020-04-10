<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Image;
class BannersController extends Controller
{
    public function addbanner(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $bannerdetails=new Banner;
            $bannerdetails->title=$data['banner_title'];
            $bannerdetails->link=$data['banner_link'];
            //adding banner image
            
             if($request->hasFile('image')){
               $_image_tmp=$request->file('image');
                if($_image_tmp->isValid()){
                   // echo "test";die;
                    $extension=$_image_tmp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $banner_image_path='images/frontend_images/banners/'.$filename;
                   
            //resize images
                    
                    Image::make($_image_tmp)->resize(1140,341)->save($banner_image_path);
                    $bannerdetails->image = $filename;
                                      
                }
            }
            if(empty($data['status'])){
              $status=0;
            }else{
              $status=1;
            }
            $bannerdetails->status=$status;
            //$product->image=$data['image'];
            $bannerdetails->save();
              return redirect('admin/add-banners')->with('flash_message_success','banner has been added');  
        }
        return view('admin.banners.add_banner');
    }
    
    public function viewbanner(Request $request){
        $bannerdetail=Banner::get();
        //dd($bannerdetail);
        return view('admin.banners.view_banner')->with(compact('bannerdetail'));
    }
    public function editbanner(Request $request,$id=null){
        $bannerdetails=Banner::where('id',$id)->first();
        //dd($bannerdetails);
       if($request->isMethod('post')){
            $data=$request->all();
           if($request->hasFile('image')){
               $_image_tmp=$request->file('image');
                if($_image_tmp->isValid()){
                   // echo "test";die;
                    $extension=$_image_tmp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $banner_image_path='images/frontend_images/banners/'.$filename;
                   
            //resize images
                    
                    Image::make($_image_tmp)->resize(1140,341)->save($banner_image_path);
                    
                                      
                }
            }elseif(empty($data['current_image'])){
               $filename=$data['current_image'];
           }else{
               $filename='';
           }
           
           
            if(empty($data['status'])){
              $status=0;
            }else{
              $status=1;
            }
           
            Banner::where('id',$id)->update([
              'title'=>$data['banner_title'],
              'link'=>$data['banner_link'],
              'status'=>$status,
              'image'=>$filename,
            ]);
            
              return redirect('admin/view-banners')->with('flash_message_success','banner has been added');  
        }
        return view('admin.banners.edit_banner')->with(compact('bannerdetails')); 
    }
    
    public function deletebannerimage($id=null){
        
        //deleting file from folder
        $bannerimage=Banner::where(['id'=>$id])->first();
        
        $image_path='images/frontend_images/banners/';
        
        
        if(file_exists($image_path.$bannerimage->image)){
            unlink($image_path.$bannerimage->image);
        }
        //deleting file name from database
        Banner::where(['id'=>$id])->update(['image'=>'']);
         return redirect()->back()->with('flash_message_success','image has been deleted successfully');
    }
    
    public function deletebanner($id=null){
        Banner::where(['id'=>$id])->delete();
         return redirect()->back()->with('flash_message_success','Banner has been deleted successfully');
    }
}
