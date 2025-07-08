@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                  <h1>Edit Fee Structure</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">Edit Fee Structure</li>
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
                          <h3 class="card-title">Edit Fee Structure</h3>
                      </div>
                      <form method="POST" action="{{ route('fee-str.update') }}">
                        @csrf
                          <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" value="{{$feeStructure->id }}">
                                
                                @error('class_id')
                                    <p class="text-danger">{{ $message }}</p>  
                                @enderror
                                <div class="form-group col-md-6">
                                    <label for=""> Select Academic Year</label>
                                    <select name="academic_year_id" class="form-control" id="">
                                        <option value="" disabled>Select Academic Year</option>
                                        @foreach ($academic_years as $academic)
                                            <option value="{{ $academic->id }}" {{ $feeStructure->academic_id == $academic->id ? 'selected' : '' }}>{{ $academic->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('academic_year_id')
                                    <p class="text-danger">{{ $message }}</p>  
                                @enderror
                                <div class="form-group col-md-6">
                                    <label for=""> Select Fee Head</label>
                                    <select name="fee_head_id" class="form-control" id="">
                                        <option value="" disabled>Select Fee Head</option>
                                        @foreach ($fee_heads as $fee_head)
                                            <option value="{{ $fee_head->id }}" {{ $feeStructure->fee_head_id == $fee_head->id ? 'selected' : '' }}>{{ $fee_head->name }}</option>
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
                                    placeholder="Enter April fee" value="{{ $feeStructure->april }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">May Fee</label>
                                    <input type="text" name="may" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter May fee" value="{{ $feeStructure->may }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">June Fee</label>
                                    <input type="text" name="june" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter June fee" value="{{ $feeStructure->june }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">August Fee</label>
                                    <input type="text" name="august" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter August fee" value="{{ $feeStructure->august }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">September Fee</label>
                                    <input type="text" name="september" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter September fee" value="{{ $feeStructure->september }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">October Fee</label>
                                    <input type="text" name="october" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter October fee" value="{{ $feeStructure->october }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">November Fee</label>
                                    <input type="text" name="november" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter November fee" value="{{ $feeStructure->november }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">December Fee</label>
                                    <input type="text" name="december" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter December fee" value="{{ $feeStructure->december }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">January Fee</label>
                                    <input type="text" name="january" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter January fee" value="{{ $feeStructure->january }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">February Fee</label>
                                    <input type="text" name="february" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter February fee" value="{{ $feeStructure->february }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="exampleInputEmail1">March Fee</label>
                                    <input type="text" name="march" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter March fee" value="{{ $feeStructure->march }}">
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
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
$(function() {
    bsCustomFileInput.init();
});
</script> 
@endsection