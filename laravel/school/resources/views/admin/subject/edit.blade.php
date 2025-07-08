@extends('admin.layout')
@section('content')
<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Class</h1>
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
                    @if(Session::has('success'))
                      <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                      <div class="card-header">
                          <h3 class="card-title">Add Class</h3>
                      </div>
                      <form method="POST" action="{{ route('sub.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                          <div class="card-body">
                            <div class="form-group col-md-6">
                                <label for=""> Select Class</label>
                                <select name="class_id" class="form-control" id="">
                                    <option value="" disabled>Select Fee Head</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ $ClassSubject->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Academic year</label>
                                  <input type="text" name="name" value="{{ old('name',$data->name) }}" class="form-control" id="exampleInputEmail1"
                                      placeholder="Enter class">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" value="{{ old('name',$data->status) }}" class="status form-control">
                                    <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Block</option>
                               </select>
                            </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Subject Type</label>
                                <select name="type"  class="status form-control">
                                    <option value="1" {{ old('type', $data->type) == 1 ? 'selected' : '' }}>Theory</option>
                                    <option value="0" {{ old('type', $data->type) == 0 ? 'selected' : '' }}>Practical</option>
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