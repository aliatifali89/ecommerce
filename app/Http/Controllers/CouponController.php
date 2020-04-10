<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
class CouponController extends Controller
{
    public function addcoupon(Request $request){
        if($request->isMethod('post')){
          $data=$request->all();
          //echo "<pre>";print_r($data);die;
         $coupontables = new Coupon;
        $coupontables->coupon_code=$data['coupon_code'];      
        $coupontables->amount=$data['amount'];    
        $coupontables->amount_type=$data['amount_type'];    
        $coupontables->expiry_date=$data['expdate'];    
        $coupontables->status=$data['status'];
        $coupontables->save();
        return redirect('/admin/view-coupons')->with('flash_message_success','coupon has been added');
//            return redirect()->action('CouponController@viewcoupon')->with('flash_message_success','coupon has been added');
        }
        return view('admin.coupons.add_coupon');
    }
    
    public function viewcoupon(){
        $coupondetails=Coupon::get();
        return view('admin.coupons.view_coupon')->with(compact('coupondetails'));
    }
    
    public function editcoupon(Request $request,$id=null){
         $data=$request->all();
             //dd($data);
         $coupondetails=Coupon::where('id',$id)->first();
         //dd($coupondetails);
         if(empty($data['status'])){
             $status=0;
             }else{
                 $status=1;
             }
         if($request->isMethod('post')){
             
             Coupon::where('id',$id)->update([
             'coupon_code'=>$data['coupon_code'],      
             'amount'=>$data['amount'],    
             'amount_type'=>$data['amount_type'],    
             'expiry_date'=>$data['expdate'],    
             'status'=>$status,
            
             ]);
              $coupondetails->save();
             return redirect('/admin/view-coupons')->with('flash_message_success','coupon has been updated');
         }
         return view('admin.coupons.edit_coupon')->with(compact('coupondetails'));
     }
    
    public function deletecoupon($id=null){
        Coupon::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','product has been deleted successfully');
    }
}
