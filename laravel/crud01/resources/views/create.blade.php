@extends('components.master');
@section('contents')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Create Product</h4>
            <a href="{{ route('p.list') }}" class="btn btn-danger"><small>back</small></a>
            {{-- <a href="{{ route('product.list') }}" class="btn btn-danger"><small>back</small></a> --}}

          </div>
        <form class="forms-sample" id="formCreateProduct" method="POST" enctype="multipart/form-data" action="{{ route('p.store') }}">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            <p></p>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Price">
            <p></p>
          </div>
          <div class="form-group">
            <label for="qty">Quantity</label>
            <input type="number" class="form-control" id="qty" name="qty" placeholder="qty">
            <p></p>
          </div>
          <div class="form-group">
            <label>File upload</label>
            <input type="file" name="image" class="form-control" id="image"> 
          </div>
          <div class="form-group">
            <label for="desc">Description</label>
            <textarea name="des" class="form-control" id="des" rows="2"></textarea>
          </div>
          <button onclick="storeProduct('#formCreateProduct')" type="button" class="btn btn-success mr-2">Save</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  const storeProduct=(form)=>{
     let payloads=new FormData($(form)[0]);
     $.ajax({
      type: "POST",
      url: '{{ route("p.store") }}',
      data: payloads,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        if(response.status==200){
          //  form reset
           $(form).trigger('reset');
           //remove feld error
           $("input").removeClass("is-invalid").siblings('p').removeClass('text-danger').text("");
          //  redirect to list page
           window.location.href="{{ route('p.list') }}";
        }else{
          let errors=response.errors;
          if(errors.name!=null){
             $("#name").addClass("is-invalid").siblings('p').addClass('text-danger').text(errors.name);
          }else{
            $("#name").removeClass("is-invalid").siblings('p').removeClass('text-danger').text("");
          }
          if(errors.price!=null){
             $("#price").addClass("is-invalid").siblings('p').addClass('text-danger').text(errors.price);
          }else{
            $("#price").removeClass("is-invalid").siblings('p').removeClass('text-danger').text("");
          }
          if(errors.qty!=null){
             $("#qty").addClass("is-invalid").siblings('p').addClass('text-danger').text(errors.qty);
          }else{
            $("#qty").removeClass("is-invalid").siblings('p').removeClass('text-danger').text("");
          }
        }
      }
     });
  }
</script>
@endsection