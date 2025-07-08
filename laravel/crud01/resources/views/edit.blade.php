@extends('components.master')
@section('contents')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Update Product</h4>
            <a href="{{ route('p.list') }}" class="btn btn-danger"><small>back</small></a>
          </div>
        <form action="{{ route('p.update',$product->id) }}" class="forms-sample" method="GET" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text"  value="{{ ($product->name) }}" class="form-control @error('name')
               is-invalid
            @enderror" id="name" name="name" placeholder="Name">
            @error('name')
            <p class=" text-danger">{{ $message }}</p>  
            @enderror
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" value="{{ ($product->price) }}" class="form-control" id="price" name="price" placeholder="Price">
            @error('price')
            <p class=" text-danger">{{ $message }}</p>  
            @enderror
          </div>
          <div class="form-group">
            <label for="qty">Qauntity</label>
            <input type="number" value="{{ ($product->qty) }}" class="form-control" id="qty" name="qty" placeholder="qty">
            @error('qty')
            <p class=" text-danger">{{ $message }}</p>  
            @enderror
          </div>
          <div class="form-group">
            <label>File upload</label>
            <input type="text" value="{{ $product->image }} " name="old_image">
            <input type="file" name="image" id="" class="form-control">
          </div>
          @if ($product->image!=null)
          <div>
            <img width="200" src="{{ asset('/uploads/'.$product->image) }}" alt="">
          </div>
            
          @endif
          <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" name="des" id="des" rows="2">{{ $product->des }}</textarea>
          </div>
          <button type="submit" class="btn btn-success mr-2">update</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
@endsection