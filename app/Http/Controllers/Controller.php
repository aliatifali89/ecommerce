<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Category;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
public static function mainCategories(){
    $maincategories2=Category::where(['parent_id'=>0])->get();
//    $maincategories=json_decode(json_encode($maincategories));
//          echo "<pre>";print_r($maincategories);
         return $maincategories2;
}    
}
