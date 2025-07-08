@extends('admin.layout')
@section('content')
<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Student Admission Form</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">Student Admission</li>
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
                    @if($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif
                      <div class="card-header">
                          <h3 class="card-title">Student Information</h3>
                      </div>
                      <form method="POST" action="{{ route('pa.store') }}" enctype="multipart/form-data">
                        @csrf
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="first_name">Name *</label>
                                          <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                                    </div>
                                </div>
                                 
                              </div>

                              
                              <div class="row">
                                
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="gender">Gender *</label>
                                          <select name="gender" class="form-control" id="gender">
                                              <option value="">Select Gender</option>
                                              <option value="male">Male</option>
                                              <option value="female">Female</option>
                                              <option value="other">Other</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profile_pic">Profile Picture</label>
                                        <div class="custom-file">
                                            <input type="file" name="profile_pic" class="custom-file-input" id="profile_pic">
                                            <label class="custom-file-label" for="profile_pic">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                              </div>

                             
                            

                              <div class="row">
                                  
                                 
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job">Job</label>
                                        <input type="text" name="job" class="form-control" id="job" placeholder="Job">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Mobile Number">
                                    </div>
                                </div>
                              </div>

                             

                              <div class="row">
                               
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="email">Email *</label>
                                          <input type="email" name="email" class="form-control" id="email" placeholder="Email" >
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status *</label>
                                        <select name="status" class="form-control" id="status" >
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                              </div>

                              <div class="row">
                                 
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="password">Password *</label>
                                          <input type="password" name="password" class="form-control" id="password" placeholder="Password" >
                                      </div>
                                  </div>
                              </div>
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
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
$(function() {
    bsCustomFileInput.init();
    
    // Initialize datepickers if needed
    $('#dob, #admission_date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });
});
</script>
@endsection