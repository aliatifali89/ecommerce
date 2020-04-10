 @php $url = url()->current() @endphp
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li @if(preg_match("/dashboard/i",$url))class="active" @endif><a href="{{url('admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span>
    
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i><span>Categories</span> <span class="label label-important">2</span></a>
      <ul @if(preg_match("/categor/i",$url)) style="display:block;" @endif>
        <li @if(preg_match("/add-category/i",$url))class="active" @endif><a href="{{url('/admin/add-category')}}">Add Category</a></li>
        <li @if(preg_match("/view-categories/i",$url))class="active" @endif><a href="{{url('/admin/view-categories')}}">View Categories</a></li>
      </ul>
    </li>
    
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
      <ul @if(preg_match("/produc/i",$url)) style="display:block;" @endif>
        <li @if(preg_match("/add-product/i",$url))class="active" @endif><a href="{{url('/admin/add-product')}}">Add Products</a></li>
        <li @if(preg_match("/view-products/i",$url))class="active" @endif><a href="{{url('/admin/view-products')}}">View Products</a></li>
      </ul>
    </li>
    
     <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>View Coupons</span> <span class="label label-important">2</span></a>
      <ul @if(preg_match("/coupons/i",$url)) style="display:block;" @endif>
        <li @if(preg_match("/add-coupons/i",$url))class="active" @endif><a href="{{url('/admin/add-coupons')}}">Add Coupons</a></li>
        <li @if(preg_match("/view-coupons/i",$url))class="active" @endif><a href="{{url('/admin/view-coupons')}}">View Coupons</a></li>
      </ul>
    </li>
    
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>View Banners</span> <span class="label label-important">2</span></a>
      <ul @if(preg_match("/banner/i",$url)) style="display:block;" @endif>
        <li @if(preg_match("/add-banners/i",$url))class="active" @endif><a href="{{url('/admin/add-banners')}}">Add Banner</a></li>
        <li @if(preg_match("/view-banners/i",$url))class="active" @endif><a href="{{url('/admin/view-banners')}}">View Banners</a></li>
      </ul>
    </li>
    </a> </li>
   
    
   
   
    
  </ul>
</div>
<!--sidebar-menu-->
