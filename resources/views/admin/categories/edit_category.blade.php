@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current"></a> </div>
    <h1>Edit Category</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Category</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/edit-category/'.$category_details->id)}}" name="adit_category" id="adit_category" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Category Name</label>
                <div class="controls">
                  <input type="text" name="name" id="name" value="{{$category_details->name}}">
                </div>
              </div>
                <div class="control-group">
                <label class="control-label">Category Levels</label>
                <div class="controls">
                  <select name="parent_id" id="parent_id" style="width:220px">
                                        
                      @foreach($level_details as $cd)
                      <option value="{{$cd->id}}" @if($cd->id == $category_details->parent_id)selected @endif >{{$cd->name}}</option>
                      @endforeach
                  </select>
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                <textarea name="description" id="description">{{$category_details->description}}</textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">URL</label>
                <div class="controls">
                  <input type="text" name="url" id="url" value="{{$category_details->url}}">
                </div>
              </div>
              
               <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="enable" id="enable" @if($category_details->status=="1") checked @endif value="1">
                </div>
              </div>
             
              <div class="form-actions">
                <input type="submit" value="Validate" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection