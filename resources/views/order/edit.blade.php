@extends('layouts.app')

@section('content')
<div class="content-body">
  <div class="container-fluid">
    @include('order.form-success')
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header" style="background-color:white;" ><h1 class="card-title"> @if(isset($order))Edit User @else Add User @endif</h1>
            <a href="{{route('order.index')}}" class="btn btn-primary btn-sm ">Back</a>
            </div>
            <div class="card-body">
              <div class="basic-form custom_file_input">
                @if(isset($order))
                  <form action="{{route('order.update',$order->id)}}" method="POST" enctype="multipart/form-data">
                  @method('put')
                  @else
                  <form action="{{route('order.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                
                  @csrf
                  <div class="form-group row">
                            <div class="form-group col-12 col-sm-6 {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title">Title</label>
                                <input id="title" @if(isset($order))  value= "{{ $order->title }}" @endif class="form-control form-control-sm" type="text" name="title" placeholder="Title">
                                @if($errors->has('title'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </em>
                                @endif
                              </div>
                            <div class="form-group col-12 col-sm-6 {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" cols="20" rows="5" id="description">@if(isset($order)) {{ $order->description }} @endif</textarea>
                                @if($errors->has('description'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </em>
                                @endif
                            </div>
                            @if(isset($order))
                            <div class="form-group col-12 col-sm-6">
                            <img src="{{asset('images/'.$order->image)}}" width="100px" height="100px">
                            </div>
                            @endif
                            <div class="form-group col-12 col-sm-6 {{ $errors->has('image') ? 'has-error' : '' }}">
                                <label for="image">Upload Image</label>
                                <input id="image" value="" class="form-control form-control-sm" type="file" name="image" >
                                @if($errors->has('image'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('image') }}
                                    </em>
                                @endif
                              </div>
                                <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                            </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('order.confirm')

@endsection
