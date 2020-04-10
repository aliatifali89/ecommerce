<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;

use Session;
use Auth;
use Image;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\Coupon;
use App\ProductsImage;
use DB;
use Str;
class ProductsController extends Controller
{
    public function addProducts(Request $request){
       $category=Category::where(['parent_id'=>0])->get();
        $categories_dropdown="<option selected disabled>Select</option>";
            foreach($category as $cat){
                $categories_dropdown.="<option value='".$cat->id."'>".$cat->name." </option>";
                $subcategory=Category::where(['parent_id'=>$cat->id])->get();
            foreach($subcategory as $scat){
                $categories_dropdown.="<option value='".$scat->id."'>&nbsp--&nbsp".$scat->name." </option>";
                //$subcategory=Category::where(['parent_id'=>$category->id])->get();    
            }
            }
//        $subcategory=Category::where(['parent_id'=>$category->id])->get();
//        
        if($request->isMethod('post')){
            $data=$request->all();
               // dd($data);
            //echo "<pre>"; print_r($data); die;
            $product = new Product;
           // dd($product);
            $product->category_id=$data['category_id'];
            $product->product_name=$data['product_name'];
            $product->product_code=$data['product_code'];
            $product->product_color=$data['product_color'];
            if(!empty($product['care'])){
              $product->care=$product['care'];
            }else{
                $product['care']=" ";
            }
            if(!empty($data['description'])){
              $product->product_description=$data['description'];
            }else{
                $product->product_description="";
            }
            $product->price=$data['price'];
            //upload images
            if($request->hasFile('image')){
               $_image_tmp=$request->file('image');
                if($_image_tmp->isValid()){
                   // echo "test";die;
                    $extension=$_image_tmp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $large_image_path='images/backend_images/products_images/large/'.$filename;
                    $medium_image_path='images/backend_images/products_images/medium/'.$filename;
                    $small_image_path='images/backend_images/products_images/small/'.$filename;
            //resize images
                    
                    Image::make($_image_tmp)->resize(700,700)->save($large_image_path);
                    Image::make($_image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($_image_tmp)->resize(300,300)->save($small_image_path);
                   // dd($_image_tmp);
                    //store image name in table
                    $product->image = $filename;
                     //echo "<pre>"; print_r($product); die;
                   // dd($product);                    
                }
            }
            if(empty($data['status'])){
              $status=0;
            }else{
              $status=1;
            }
            $product->status=$status;
            //$product->image=$data['image'];
            $product->save();
              return redirect('admin/view-products')->with('flash_message_success','product has been added');
        }
         // echo "<pre>"; print_r($product); die;
        return view('admin.products.products')->with(compact('category','categories_dropdown'));
    }
    
    public function viewProducts(){
        $products=Product::OrderBy('id','DESC')->get();
       // $products=json_decode(json_encode($products));
        foreach($products as $key => $val){
           
            $category_name=Category::where(['id'=>$val->category_id])->first();
           // dd($category_name);
            $products[$key]->category_name = $category_name->name;
          
        }
          // dd($products);
       //echo "<pre>"; print_r($products); die;
        return view('admin.products.view_products')->with(compact('products'));
    }
    
    public function editProduct(Request $request,$id=null){
        
        if($request->isMethod('post')){
        $product_detailss=$request->all();
            
         if($request->hasFile('image')){
               $_image_tmp=$request->file('image');
                if($_image_tmp->isValid()){
                   // echo "test";die;
                    $extension=$_image_tmp->getClientOriginalExtension();
                    $filename = rand(111,9999).'.'.$extension;
                    $large_image_path='images/backend_images/products_images/large/'.$filename;
                    $medium_image_path='images/backend_images/products_images/medium/'.$filename;
                    $small_image_path='images/backend_images/products_images/small/'.$filename;
            //resize images
                    
                    Image::make($_image_tmp)->save($large_image_path);
                    Image::make($_image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($_image_tmp)->resize(300,300)->save($small_image_path);
                   // dd($_image_tmp);
                    //store image name in table
                    
                     //echo "<pre>"; print_r($product); die;
                   // dd($product);   
      
                }
            }else{
             $filename=$product_detailss['cimage'];
         }
         if(empty($product_detailss['status'])){
              $status=0;
            }else{
              $status=1;
            };  
        Product::where(['id'=>$id])->update([
             
           'product_name'=>$product_detailss['name'],
           //'category_id'=>$product_detailss['category_id'],
           'product_color'=>$product_detailss['color'],
           'product_description'=>$product_detailss['description'],
           'care'=>$product_detailss['care'],
           'price'=>$product_detailss['price'],
           'product_code'=>$product_detailss['code'],
           'product_color'=>$product_detailss['color'],
            'image'=>$filename,     
            'status'=>$status,
        ]);
      return redirect()->back()->with('flash_message_success','product has been updated successfully');
        
    }
     // echo "test";
         //categories dropdown ends 
         $product_details=Product::where(['id'=>$id])->first();
         $category=Category::where(['parent_id'=>0])->get();
        $categories_dropdown="<option selected disabled>Select</option>";
            foreach($category as $cat){
                if($cat->id==$product_details->category_id){
                    $selected="selected";
                }else{
                    $selected="";
                }
                $categories_dropdown.="<option value='".$cat->id."' ".$selected.">".$cat->name." </option>";
                $subcategory=Category::where(['parent_id'=>$cat->id])->get();
            foreach($subcategory as $scat){
                if($scat->id==$product_details->category_id){
                    $selected="selected";
                }else{
                    $selected="";
                }
                $categories_dropdown.="<option value='".$scat->id."' ".$selected.">&nbsp--&nbsp".$scat->name." </option>";
            }
            }
         //categories dropdown ends         
   return view('admin.products.edit_products')->with(compact('product_details','categories_dropdown'));
}
    
    public function deleteproductsimage($id=null){
        
        //deleting file from folder
        $productimage=Product::where(['id'=>$id])->first();
        
        $large_image_path='images/backend_images/products_images/large/';
        $medium_image_path='images/backend_images/products_images/medium/';
        $small_image_path='images/backend_images/products_images/small/';
        
        if(file_exists($large_image_path.$productimage->image)){
            unlink($large_image_path.$productimage->image);
        }
        
         if(file_exists($medium_image_path.$productimage->image)){
            unlink($medium_image_path.$productimage->image);
        }
        
         if(file_exists($small_image_path.$productimage->image)){
            unlink($small_image_path.$productimage->image);
        }
        
        //deleting file name from database
        Product::where(['id'=>$id])->update(['image'=>'']);
         return redirect()->back()->with('flash_message_success','image has been deleted successfully');
    }
    
    public function deleteproducts($id=null){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','product has been deleted successfully');
    }
    
    public function addpAttributes(Request $request,$id=null){
        $p_details=Product::with('attributes')->where(['id'=>$id])->first();
//        $p_details=json_decode(json_encode($p_details));
//        echo "<pre>";print_r($p_details);die;
        if($request->isMethod('post')){
         
        $data=$request->all();
        foreach($data['sku'] as $key => $value){ 
            
        if(!empty($value)){
            
            $skuattribute=ProductsAttribute::where('sku',$value)->count(); //this should be unique in all over the table
            if($skuattribute>0){
                return redirect()->back()->with('flash_message_error','sku already exists');
            }
             $sizeattribute=ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();//this should be unique in particular product only not in table
              if($sizeattribute>0){
                return redirect()->back()->with('flash_message_error','"'.$data['size'][$key].'" already exists');
            }
        $attributes = new ProductsAttribute;    
        $attributes->product_id=$id;    
        $attributes->sku=$value;        
        $attributes->size=$data['size'][$key];   
        $attributes->price=$data['price'][$key]; 
        $attributes->stock=$data['stock'][$key]; 
            
        $attributes->save();
      
            
            
        //echo "<pre>";print_r($data);die;
        }
           
           
        }
            return redirect()->back()->with('flash_message_success','attribute has been added successfully');
        }
        return view('admin.products.addattributes')->with(compact('p_details'));
    }
    
    public function editpAttributes(Request $request,$id=null){
       if($request->isMethod('post')){ 
           $data = $request->all();
           //echo "<pre>"; print_r($data); die;
           foreach($data['attr_id'] as $key=>$attr){
           ProductsAttribute::where(['id'=>$data['attr_id'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
           }
           return redirect()->back()->with('flash_message_success','Product attribute has been updated successfully');
        }
    }
    
    public function addImages(Request $request,$id=null){
         $p_details=Product::with('attributes')->where(['id'=>$id])->first();
         if($request->isMethod('post')){
             $data=$request->all();
             //echo "<pre>"; print_r($data); die;
             if($request->hasFile('image')){
                 $files=$request->file('image');
                  
              
                 foreach($files as $file){ //loop here because of multiple files
                $image = new ProductsImage;
                
                 $extension=$file->getClientOriginalExtension();
                 $filename = rand(111,9999).'.'.$extension;
                  $large_image_path='images/backend_images/products_images/large/'.$filename;
                    $medium_image_path='images/backend_images/products_images/medium/'.$filename;
                    $small_image_path='images/backend_images/products_images/small/'.$filename;
           
                    
                    Image::make($file)->resize(700,700)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);
                   
                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
              
                    $image->save();
                      
                 }
             }
             
             return redirect('/admin/addp-images/'.$id)->with('flash_message_success','Product image has been added successfully');
         }
        $pimage = ProductsImage::get();
       // echo "<pre>"; print_r($pimage); die;
        return view('admin.products.add_images')->with(compact('p_details','pimage'));
    }
    
    public function deletealtimage($id=null){
        
        //deleting file from folder
        $productimage=ProductsImage::where(['id'=>$id])->first();
        
        $large_image_path='images/backend_images/products_images/large/';
        $medium_image_path='images/backend_images/products_images/medium/';
        $small_image_path='images/backend_images/products_images/small/';
        
        if(file_exists($large_image_path.$productimage->image)){
            unlink($large_image_path.$productimage->image);
        }
        
         if(file_exists($medium_image_path.$productimage->image)){
            unlink($medium_image_path.$productimage->image);
        }
        
         if(file_exists($small_image_path.$productimage->image)){
            unlink($small_image_path.$productimage->image);
        }
        
        //deleting file name from database
        ProductsImage::where(['id'=>$id])->delete();
         return redirect()->back()->with('flash_message_success','image has been deleted successfully');
    }
    
    public function deleteattributes($id=null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','product has been deleted successfully');
    }
    
    public function products($url=null){
        //showing 404 page
        $countCategory=Category::where(['url'=>$url,'status'=>1])->count();
       // echo $countCategory;die;
        if($countCategory==0){
            abort(404);
        }
        
        //getting all cat and subcat
         $categories=Category::with('categories2')->where(['parent_id'=>0])->get();
        
        $categorydetails=Category::where(['url'=>$url])->first();
        
        if($categorydetails->parent_id==0){
            
            $subcategories = Category::where(['parent_id'=>$categorydetails->id])->get();
            
//             $subcategories=json_decode(json_encode($subcategories));
//            echo "<pre>"; print_r($subcategories); die;
            
            foreach($subcategories as $subcat){
                $cat_ids[] = $subcat->id;
            }
            $ProductAll=Product::wherein('category_id',$cat_ids)->get();
            $ProductAll=json_decode(json_encode($ProductAll));
           // echo "<pre>"; print_r($ProductAll); die;
        }else{
        
        $ProductAll=Product::where(['category_id'=>$categorydetails->id])->get();
        //echo "<pre>"; print_r($ProductAll); die;
        }
        return view('products.listing')->with(compact('ProductAll','categorydetails','categories'));
    }
    
     public function product($id=null){
        $categories=Category::with('categories2')->where(['parent_id'=>0])->get();
           //showing 404 page
        $countProduct=Product::where(['id'=>$id,'status'=>1])->count();
       // echo $countCategory;die;
        if($countProduct==0){
            abort(404);
        }
        $productdetails=Product::with('attributes')->where('id',$id)->first();
         
//         $productdetails=json_decode(json_encode($productdetails));
//         echo "<pre>"; print_r($productdetails); die;
         
         $related_product=Product::where('id','!=',$id)->where(['category_id'=>$productdetails->category_id])->get();
         
//         foreach($related_product->chunk(3) as $chunk){ //chunk array to show limited records at a time
//            
//                foreach($chunk as $item){
//                    echo $item; echo "<br><br>";
//                 }
//             echo "<br><br><br>";
//            
//         }die;
         
         $altimages=ProductsImage::where(['product_id'=>$id])->get();
           //echo "<pre>"; print_r($altimages); die;                                 
//         $productdetails=json_decode(json_encode($productdetails));
//         echo "<pre>"; print_r($productdetails); die;
         $total_stock=ProductsAttribute::where(['product_id'=>$id])->sum('stock');
         
         return view('products.details')->with(compact('productdetails','categories','altimages','total_stock','related_product'));
        
       
    }
    
    public function getproductprice(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $proarr=explode('-',$data['idsize']);
        //echo $proarr[0];echo $proarr[1];
        $proattr=ProductsAttribute::where(['product_id'=>$proarr[0],'size'=>$proarr[1]])->first();
        echo $proattr->price;
        echo "#";
        echo $proattr->stock;
    
    }
    
     public function addtocart(Request $request){
         //forget session to remove coupon on update
         Session::forget('CouponAmount');
         Session::forget('CouponCode');
         
        $data=$request->all();
        //echo "<pre>"; print_r($data); die;
         if(empty($data['session_id'])){
             $data['session_id']='';
         }
         
         if(empty($data['user_email'])){
             $data['user_email']='';
         }
         
          if(empty($data['size'])){
             $data['size']='';
         }
         $session_id=Session::get('session_id');
         //dd($session_id);
         if(empty($session_id)){
         $session_id = Str::random(40);
         
         Session::put('session_id',$session_id);
         };
         $sizearr = explode("-",$data['size']);
         
         
          
         //to avoid selecting same existing product again in cart
          $count_product=DB::table('cart')->where(['product_id'=>$data['product_id'],'product_color'=>$data['color'],'size'=>$sizearr[1],'session_id'=>$session_id])->count();
         
         if($count_product>0){
              return redirect()->back()->with('flash_message_error','product has already been selected');
         }else{
             //inserting values of sku column from productattribute table inside product_code column
             
             //we can select when no need comparison
//             $getsku = ProductsAttribute::select('sku')->get();
//             dd($getsku);
             
            $getsku = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sizearr[1]])->first();
             
             //inserting data into 'cart' table which is sent by details.blade.php page as hidden input type 
            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$getsku->sku,'product_color'=>$data['color'],'size'=>$sizearr[1],'price'=>$data['price'],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]); 
         }
         //echo "$count_product";die;
         return redirect('cart')->with('flash_message_success','order has been added successfully');
    }
    
    public function cart(Request $request,$id=null){
        $session_id=Session::get('session_id');
        
        $usersession=DB::table('cart')->where(['session_id'=>$session_id])->get();
        //echo "<pre>"; print_r($usersession); die;
        foreach($usersession as $key=>$pimage){
            //echo $pimage->product_id;die;
          $pimage=Product::where('id',$pimage->product_id)->first();
       // echo "<pre>"; print_r($pimage->image); die;
            
            $usersession[$key]->image=$pimage->image;
        }
       // echo "<pre>"; print_r($usersession); die;
        return view('products.cart')->with(compact('usersession'));
    }
    
    public function deletecartproducts($id=null){
        //forget session to remove coupon on update
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        
     //   echo "test";die;
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_success','order has been deleted successfully');
    }
    
    public function updatecartquantity(Request $request,$id=null,$quantity=null){
        //forget session to remove coupon on update
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        
        $cartdetails=DB::table('cart')->where('id',$id)->first();
        //dd($cartdetails);
        $getstock=ProductsAttribute::where('sku',$cartdetails->product_code)->first();
        //dd($getstock);
        $updated_quantity=$cartdetails->quantity+$quantity;
        if($getstock->stock>=$updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
        return redirect('cart')->with('flash_message_success','quantity has been updated successfully'); 
        }else{
         return redirect()->back()->with('flash_message_error','product quantity has exceeded stock limit');
        }
    }
    
    public function applycoupon(Request $request){
        
        //forget session to remove coupon on update
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        
        $coupon=$request->all();
        //dd($coupon);
        $coupons=Coupon::where('coupon_code',$coupon['coupon_code'])->count();
        
        //if coupon exist
        if($coupons==0){
            return redirect()->back()->with('flash_message_error','coupon does not exist'); 
        }
        else{
            $coupondetails=Coupon::where('coupon_code',$coupon['coupon_code'])->first();
            
            //if coupon is inactive
            if($coupondetails->status==0){
            return redirect()->back()->with('flash_message_error','coupon is Inactive');
            }
            
            //if coupon is expired
            $expiry_date=$coupondetails->expiry_date;
            $current_date=date('Y-m-d');
            //dd($current_date);
            if($expiry_date<$current_date){
                return redirect()->back()->with('flash_message_error','coupon has expired');
            }
            
                //return redirect()->back()->with('flash_message_error','coupon is active');
            
            
            //getting cart total amount
            
            //
                $session_id=Session::get('session_id');
                $usersession=DB::table('cart')->where(['session_id'=>$session_id])->get();
                //dd($usersession);
                $total_amount=0;
            
                foreach($usersession as $item){
                  $total_amount=$total_amount + ($item->price * $item->quantity);    
        }
                
            //check if coupon is in percentage or fixed
            if($coupondetails->amount_type=="Fixed"){
                $coupon_amount=$coupondetails->amount;
            }else{
                $coupon_amount=$total_amount * ($coupondetails->amount/100);
            }
           // echo $coupon_amount;die;     
             
            }
        //adding coupon code & amount in session
        Session::put('CouponAmount',$coupon_amount);
        Session::put('CouponCode',$coupon['coupon_code']);
        //dd(Session::get('CouponCode'));
       return redirect()->back()->with('flash_message_success','coupon has applied successfully');
    }
}
   




