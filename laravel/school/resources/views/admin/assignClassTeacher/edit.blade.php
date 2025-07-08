
@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Class Subjects</h1>
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
              <h3 class="card-title">Edit Class Subjects</h3>
            </div>
            <form method="POST" action="{{ route('ct.update') }}">
              @csrf
              <input type="hidden" name="id" value="{{ $ClassSubject->id }}">
              <div class="card-body">
                <div class="form-group col-md-6">
                  <label>Select Class</label>
                  <select name="class_id" class="form-control">
                    @foreach ($classes as $class)
                      <option value="{{ $class->id }}" {{ $ClassSubject->class_id == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="1" {{ $ClassSubject->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $ClassSubject->status == 0 ? 'selected' : '' }}>Block</option>
                  </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Subjects</label>
                    <div class="row">
                        @foreach ($subjects as $subject)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        value="{{ $subject->id }}" 
                                        name="subject_id[]" 
                                        id="subject{{ $subject->id }}"
                                        {{ in_array($subject->id, $selectedSubjects) ? 'checked' : '' }}
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
<script>
$(function() {
  bsCustomFileInput.init();
});
</script> 
@endsection
{{-- @extends('admin.layout')
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
                      <form method="POST" action="{{ route('cs.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $ClassSubject->id }}">
                          <div class="card-body">
                             
                              <div class="form-group col-md-6">
                                <label for=""> Select Classes</label>
                                <select name="class_id" class="form-control" id="">
                                    <option value="" disabled>Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ $ClassSubject->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" value="{{ old('name',$ClassSubject->status) }}" class="status form-control">
                                    <option value="1" {{ old('status', $ClassSubject->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $ClassSubject->status) == 0 ? 'selected' : '' }}>Block</option>
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
@endsection --}}