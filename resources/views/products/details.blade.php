@extends('layouts.frontlayout.front_design');
@section('content')

<section>
    <div class="container">
        <div class="row">
            @if(Session::has('flash_message_error'))
           <div class="alert alert-error alert-block" style="background-color:#E44D26;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{!!Session('flash_message_error')!!}</strong>
           </div>
        @endif
            <div class="col-sm-3">
               @include('layouts.frontlayout.front_sidebar')
            </div>
      
            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                            <a href="{{asset('images/backend_images/products_images/large/'.$productdetails->image)}}">
                             <img style="width:300px;" class="mainimage" src="{{asset('images/backend_images/products_images/medium/'.$productdetails->image)}}" alt="" /> 
                            </a>
                               </div>
                               
<!--                            <h3>ZOOM</h3>-->
                        </div>
                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active thumbnails">
                                  <a href="{{asset('images/backend_images/products_images/large/'.$productdetails->image)}}" data-standard="{{asset('images/backend_images/products_images/small/'.$productdetails->image)}}">
                                 <img style="width:80px;" class="changeimage" src="{{asset('images/backend_images/products_images/small/'.$productdetails->image)}}" alt="" /> 
                                </a>
                                   @foreach($altimages as $altimage)
                                   <a href="{{asset('images/backend_images/products_images/large/'.$altimage->image)}}" data-standard="{{asset('images/backend_images/products_images/small/'.$altimage->image)}}">
                                   
						
                                  <img class="changeimage" style="width:80px; cursor:pointer;" src="{{asset('images/backend_images/products_images/small/'.$altimage->image)}}" alt="">
                                    </a>
                                    @endforeach
                                </div>

                            </div>

                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-7">
                       <form name="addtocartform" id="addtocartform" method="post" action="{{url('add-cart')}}">{{csrf_field()}}
                       <input type="hidden" name="product_id" value="{{$productdetails->id}}">
                       <input type="hidden" name="product_name" value="{{$productdetails->product_name}}">
                       <input type="hidden" name="code" value="{{$productdetails->product_code}}">
                       <input type="hidden" name="color" value="{{$productdetails->product_color}}">
                       <input type="hidden" name="price" value="{{$productdetails->price}}">
                        <div class="product-information">
                            <!--/product-information-->
                            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                            <h2>{{$productdetails->product_name}}</h2>
                            <p>Code: {{$productdetails->product_code}}</p>
                            <p>
                                <select name="size" id="selsize" style="width:150px;">
                                    <option selected value="">Select size</option>
                                    @foreach($productdetails->attributes as $size)
                                    <option value="{{$productdetails->id}}-{{$size->size}}">{{$size->size}}</option>
                                    @endforeach
                                </select>
                            </p>
                            <img src="images/product-details/rating.png" alt="" />
                            <span>
                                <span id="getprice">Price: US {{$productdetails->price}}</span>
                                <label>Quantity:</label>
                                <input type="text" name="quantity" value="1" />
                                @if($total_stock>0)
                                <button type="submit" id="cartbtn" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    
                                    Add to cart
                                    
                                </button>
                                @endif
                            </span>
                            <p><b>Availability:</b><span id="availability">@if($total_stock>0) In Stock @else Out Of Stock @endif</span></p>
                            <p><b>Condition:</b> New</p>

                            <a href=""><img src="#" class="share img-responsive" alt="" /></a>
                        </div>
                        <!--/product-information-->
                        </form>
                    </div>
                </div>
                <!--/product-details-->

                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#care" data-toggle="tab">Material and Care</a></li>
                            <li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
                            <div class="col-sm-12">
                                <p>{{$productdetails->product_description}}</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="care">

                            <div class="col-sm-12">
                                <p>{{$productdetails->care}}</p>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="delivery">
                            <div class="col-sm-12">
                                <p>100% original product</p>
                            </div>

                        </div>

                       
                    </div>
                </div>
                <!--/category-tab-->

                    <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
							<?php $count=1;?>
							@foreach($related_product->chunk(3) as $chunk )
								<div <?php if($count==1){ ?> class="item active" <?php } else{?>class="item"> <?php }; ?>>
									@foreach($chunk as $item )
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width:200px;" src="{{asset('images/backend_images/products_images/small/'.$item->image)}}" alt="" />
													<h2>{{$item->price}}</h2>
													<p>{{$item->product_name}}</p>
													<a href="{{url('product/'.$item->id)}}"  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									@endforeach
								</div>
								<?php $count++; ?>
							@endforeach	
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

@endsection
