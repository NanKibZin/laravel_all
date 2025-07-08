@extends('admin.layout')
@section('content')
<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>General Form</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">Class</li>
                  </ol>
              </div>
          </div>
      </div>
  </section>

  <section class="content">
      <div class="container-fluid">
          <div class="row">

              <div class="col-md-12">

                  <div class="card card-primary">
                    @include('message')
                      <div class="card-header">
                          <h3 class="card-title">Add Acadimic year</h3>
                      </div>
                      <form method="POST" action="{{ route('class.store') }}">
                        @csrf
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Class</label>
                                  <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                      placeholder="Enter Class">
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Status</label>
                                  <select name="status" class="status form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                 </select>
                              </div>

                          <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </form>
                  </div>


               
               

                
              </div>


             
          </div>

      </div>
  </section>

</div>
@endsection
@section('customJs')
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function() {
    bsCustomFileInput.init();
});
</script> 
@endsection