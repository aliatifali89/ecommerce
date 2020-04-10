<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
 public function login(Request $request){
     if($request->isMethod('post')){
         $data=$request->input();
         if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
            //Session::put('adminsession',$data['email']);
            return redirect('admin/dashboard');
         }
         else{
             //echo"failed"; die;
             return redirect('/admin')->with('flash_error_message','Invalid username and password');
         }
         
     }
         
     return view('admin.admin_login');
 }
public function dashboard(){
    // if(session::has('adminsession')){
       
    // }else{
    //     return redirect('/admin')->with('flash_error_message','please login to access');
    // }
     return view('admin.dashboard');
}

public function settings(){
    
     return view('admin.settings');
}

public function logout(){
    
    Session::flush();
    return redirect('/admin')->with('flash_error_success','logout successfully');
}

public function chk_pwd(Request $request){
    $data=$request->all();
    $current_pass=$data['current_pwd'];
    $check_pass=User::where(['admin' => '1'])->first();
    if(Hash::check($current_pass,$check_pass->password)){
        echo "true";die;
    }
    else{
        echo "false";die;
    }
}
    public function update_password(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
           //echo "<pre>"; print_r($data); die;
        $check_password = User::where(['email' => Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
         if(Hash::check($current_password,$check_password->password)){
            $password=bcrypt($data['new_pwd']);
            User::where('admin', '1')->update(['password'=> $password]);
            return redirect('/admin/settings')->with('flash_success_message','updated successfully'); 
        }
        else{
            return redirect('admin/settings')->with('flash_error_message','incorrect current password'); 

        }   
        }
    }
}
