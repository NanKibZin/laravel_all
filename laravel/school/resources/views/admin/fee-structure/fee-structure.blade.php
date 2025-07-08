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
                      <li class="breadcrumb-item active">Fee Structure</li>
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
                          <h3 class="card-title">Add Fee Structure</h3>
                      </div>
                      <form method="POST" action="{{ route('fee-str.store') }}">
                        @csrf
                          <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for=""> Select Classes</label>
                                    <select name="class_id" class="form-control" id="">
                                        <option value="" disable selected>Select Class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('class_id')
                    <p class="text-danger">{{ $message }}</p>  
                    @enderror
                                <div class="form-group col-md-6">
                                    <label for=""> Select academic</label>
                                    <select name="academic_year_id" class="form-control" id="">
                                        <option value="" disable selected>Select academic</option>
                                        @foreach ($academic_years as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('academic_year_id')
                    <p class="text-danger">{{ $message }}</p>  
                    @enderror
                                <div class="form-group col-md-6">
                                    <label for=""> Select Fee head</label>
                                    <select name="fee_head_id" class="form-control" id="">
                                        <option value="" disable selected>Select Fee Head</option>
                                        @foreach ($fee_heads as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @error('fee_head_id')
                    <p class="text-danger">{{ $message }}</p>  
                    @enderror
                            </div>
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">April Fee</label>
                                    <input type="text" name="april" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter April fee">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">May Fee</label>
                                    <input type="text" name="may" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter May fee">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">june Fee</label>
                                    <input type="text" name="june" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter june fee">
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">August Fee</label>
                                    <input type="text" name="august" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter August fee">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">september Fee</label>
                                    <input type="text" name="september" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter September fee">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">October Fee</label>
                                    <input type="text" name="october" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter October fee">
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">November Fee</label>
                                    <input type="text" name="november" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter November fee">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">December Fee</label>
                                    <input type="text" name="december" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter December fee">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">January Fee</label>
                                    <input type="text" name="january" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter October fee">
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">Febuary Fee</label>
                                    <input type="text" name="February" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter February fee">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">march Fee</label>
                                    <input type="text" name="march" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter march fee">
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
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function() {
    bsCustomFileInput.init();
});
</script> 
@endsection