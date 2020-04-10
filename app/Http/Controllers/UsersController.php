<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function userlogin(Request $request){ 
        //echo "success";die;
        return view('users.login_register');
    }
    
    public function account(Request $request){
        $user_id=Auth::user()->id; //we use Auth facade here to logged in user info
        //echo "$user_id";die;
        $userdetails=User::find($user_id);
        $countrydetails=Country::get();
        //echo "$data";die;
        if($request->isMethod('post')){
            $formdata=$request->all();
            
            if(empty($formdata['name'])){
                return redirect()->back()->with('flash_message_error','please provide name to update record');
            };
            if(empty($formdata['address'])){
                return redirect()->back()->with('flash_message_error','please provide address to update record');
            };
            if(empty($formdata['city'])){
                return redirect()->back()->with('flash_message_error','please provide city to update record');
            };
            if(empty($formdata['state'])){
                return redirect()->back()->with('flash_message_error','please provide state to update record');
            };
            if(empty($formdata['country'])){
                return redirect()->back()->with('flash_message_error','please select country to update record');
            };
            if(empty($formdata['pincode'])){
                return redirect()->back()->with('flash_message_error','please provide pincode to update record');
            };
            if(empty($formdata['mobile'])){
                return redirect()->back()->with('flash_message_error','please provide mobile to update record');
            };   
            User::where('id',$user_id)->update([
                'name'=>$formdata['name'],
                'address'=>$formdata['address'],
                'city'=>$formdata['city'],
                'state'=>$formdata['state'],
                'country'=>$formdata['country'],
                'pincode'=>$formdata['pincode'],
                'mobile'=>$formdata['mobile'],
            ]);
            return redirect()->back()->with('flash_message_success','user account has been updated');

        }
               
        return view('users.account')->with(compact('countrydetails','userdetails'));
    }
    
    public function login(Request $request){
        if($request->isMethod('post')){
        $data=$request->all();
        //echo "success";die;
        if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            Session::put('frontsession',$data['email']);
            return redirect('/cart');
        }else{
            return redirect()->back()->with('flash_message_error','email or password is invalid');
            }
        }
    }
    public function chk_pwd(Request $request){
    $data=$request->all();
    $current_pass=$data['current_pwd'];
    $user_id=Auth::User()->id;    
    $check_pass=User::where(['id' => $user_id])->first();
    if(Hash::check($current_pass,$check_pass->password)){
        echo "true";die;
    }
    else{
        echo "false";die;
    }
}
    public function register(Request $request){
        $data=$request->all();
        //dd($data);
        if($request->isMethod('post')){
            $useremail=User::where('email',$data['email'])->count();
            
            if($useremail>0){
                return redirect()->back()->with('flash_message_error','User already exists');
            }else{
                //echo "success";die;
                $user=new User;
                $user->name=$data['name'];
                $user->email=$data['email'];
                $user->password=bcrypt($data['password']);
                $user->save();
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontsession',$data['email']);
                    return redirect('/cart');
                };
            }
            
            }
            
   }
    public function updatepassword(Request $request){
        $password=$request->all();
        $new_pwd=bcrypt($password['new_pwd']);
        $con_pwd=$password['con_pwd'];
        $current_formpwd=$password['current_pwd'];
        //dd($current_formpwd);
        $user_id=Auth::user()->id;
        if($request->isMethod('post')){
            $current_pwd=User::where('id',$user_id)->first();
          // dd($current_pwd);
            if(Hash::check($current_formpwd,$current_pwd->password)){
                //echo "test";
                User::where('id',$user_id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Password has been updated successfully');
            }else{
                return redirect()->back()->with('flash_message_error','Current Password is incorrect');
            }            
        }
    }
    
    public function userlogout(Request $request){
        //echo "success";die;
        Auth::logout();
        Session::forget('frontsession');
        return redirect('/');
    }
   public function checkemail(Request $request){
       $data=$request->all();
       $checkemail=User::where('email',$data['email'])->count();
            
            if($checkemail>0){
                echo "false";
            }else{
                echo "true";die;
            }
   } 
        
}
    