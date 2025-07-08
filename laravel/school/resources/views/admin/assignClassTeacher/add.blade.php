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
                    @if(Session::has('success'))
                      <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                      <div class="card-header">
                          <h3 class="card-title">Add Class & Subject</h3>
                      </div>
                      <form method="POST" class="px-4" action="{{ route('ct.add') }}">
                        @csrf
                        <div class="card-body px-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <select name="class_id" class="status form-control">
                               @foreach ($classes as $class )
                                  <option value="{{ $class->id }}">{{ $class->name }}</option>
                              @endforeach
                               </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Teacher</label>
                               
                                <div class="row">
                                    @foreach ($teacher as $subject)
                                        <div class="col-md-4 mb-2">
                                            <div class="form-check">
                                                <input 
                                                    class="form-check-input" 
                                                    type="checkbox" 
                                                    value="{{ $subject->id }}" 
                                                    name="subject_id[]" 
                                                    
                                                >
                                                <label class="form-check-label" for="subject{{ $subject->id }}">
                                                    {{ $subject->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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