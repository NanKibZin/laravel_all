@extends('admin.layout')
@section('content')
<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Edit Parent Information</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('pa.read') }}">Parents</a></li>
                      <li class="breadcrumb-item active">Edit Parent</li>
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
                          <h3 class="card-title">Edit Parent Information</h3>
                      </div>
                      <form method="POST" action="{{ route('pa.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $student->id }}">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="first_name">Name *</label>
                                          <input type="text" name="first_name" class="form-control" id="first_name" 
                                          value="{{ old('first_name', $student->name) }}" placeholder="Full Name">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" 
                                        value="{{ old('address', $student->address) }}" placeholder="Address">
                                    </div>
                                </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="gender">Gender *</label>
                                          <select name="gender" class="form-control" id="gender">
                                              <option value="">Select Gender</option>
                                              <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                              <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                              <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
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
                                        @if($student->image)
                                            <div class="mt-2">
                                                <img src="{{ asset($student->image) }}" alt="Profile Image" style="max-width: 100px;">
                                                <p class="text-muted">Current Image</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="job">Job</label>
                                        <input type="text" name="job" class="form-control" id="job" 
                                        value="{{ old('job', $student->job) }}" placeholder="Job">
                                    </div>
                                    <div class="form-group">
                                        <label for="job">password</label>
                                        <input type="password" name="password" class="form-control" id="job" 
                                        value="" placeholder="Job">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control" id="mobile_number" 
                                        value="{{ old('mobile_number', $student->mobile_number) }}" placeholder="Mobile Number">
                                    </div>
                                </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="email">Email *</label>
                                          <input type="email" name="email" class="form-control" id="email" 
                                          value="{{ old('email', $student->email) }}" placeholder="Email">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status *</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="1" {{ old('status', $student->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $student->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                              </div>

                            
                          </div>
                          <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Update</button>
                              <a href="{{ route('pa.read') }}" class="btn btn-default">Cancel</a>
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
});
</script>
@endsection