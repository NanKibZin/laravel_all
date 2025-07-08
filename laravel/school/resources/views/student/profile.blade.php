@extends('admin.layout')
@section('content')
<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Edit Student Information</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('stu.create') }}">Students</a></li>
                      <li class="breadcrumb-item active">Edit Student</li>
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
                          <h3 class="card-title">Edit Student Information</h3>
                      </div>
                      <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        {{ csrf_field() }}
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $student->id }}">
                                          <label for="first_name">First Name *</label>
                                          <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{ old('first_name', $student->first_name) }}">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="last_name">Last Name *</label>
                                          <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="{{ old('last_name', $student->last_name) }}">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="admission_number">Admission Number *</label>
                                          <input type="text" name="admission_number" class="form-control" id="admission_number" placeholder="Admission Number" value="{{ old('admission_number', $student->admission_number) }}">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="roll_number">Roll Number</label>
                                          <input type="text" name="roll_number" class="form-control" id="roll_number" placeholder="Roll Number" value="{{ old('roll_number', $student->roll_number) }}">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="class_id">Class *</label>
                                          <select name="class_id" class="form-control" id="class_id">
                                              <option value="">Select Class</option>
                                              @foreach($classes as $class)
                                                  <option value="{{ $class->id }}" {{ (old('class_id', $student->class_id) == $class->id ? 'selected' : '') }}>{{ $class->name }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
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
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="dob">Date of Birth *</label>
                                          <input type="date" name="dob" class="form-control" id="dob" value="{{ old('dob', $student->dob) }}">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="caste">Caste</label>
                                          <input type="text" name="caste" class="form-control" id="caste" placeholder="Caste" value="{{ old('caste', $student->caste) }}">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="admission_date">Admission Date *</label>
                                          <input type="date" name="admission_date" class="form-control" id="admission_date" value="{{ old('admission_date', $student->admission_date) }}">
                                      </div>
                                  </div>
                                 
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number', $student->mobile_number) }}">
                                    </div>
                                </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="email">Email *</label>
                                          <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email', $student->email) }}">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="status">Status *</label>
                                          <select name="status" class="form-control" id="status">
                                              <option value="1" {{ old('status', $student->status) == 1 ? 'selected' : '' }}>Active</option>
                                              <option value="0" {{ old('status', $student->status) == 0 ? 'selected' : '' }}>Inactive</option>
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
                          </div>
                          <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Update</button>
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
        format: 'yyyy-mm-dd',
        autoclose: true
    });
});
</script>
@endsection