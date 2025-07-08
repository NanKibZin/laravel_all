@extends('components.master')
@section('contents')
<h1>Product Page</h1>
<div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        @include('message.messages')
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0">Product Stock</h4>
          <form>
            <input type="search" name="search" class="search" class="form-control" style="width:300px" placeholder="search product here....">
          </form>
          <a href="{{ route('p.create') }}" class="btn btn-danger"><small>Add Product</small></a>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

                @foreach($products as $p)
              <tr>
                <td>
                  <input onchange="handleSelect()" type="checkbox" value="{{ $p->id }}">
                  {{ $p->id }}
                </td>
                <td>
                  <img src="{{ asset('uploads/'.$p->image) }}" alt="">
                </td>
                <td>{{ $p->name }}</td>
                <td>{{$p->price}}</td>
                <td>{{ $p->qty }}</td>
                <td>
                    <a href="{{ route('p.edit',$p->id) }}"  class=" btn btn-danger">Edit</a>
                    <a onclick="return confirm('do you want to delete this products?')" href="{{ route('p.delete',$p->id) }}" class=" btn btn-primary">delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class=" d-flex justify-content-between">

            <div class=" mt-3">
              {{ $products->links() }}
            </div>
            <div>
              <button product-id="" onclick="deleteWithSelected()" id="btn_delete_selected" class="btn btn-danger p-4 d-none">Delete with selected</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>

  const handleSelect=()=>{
    let selectedProducts=[];
    //  $('input[type=checkbox]:checked').each(function(){
    //   selectedProducts.push($("#btn_delete_selected").val());
    //  });
    $('input[type=checkbox]:checked').each(function(){
    selectedProducts.push($(this).val());
});

    //  if(selectedProducts.length>=1){
    //   //convert array to string
    //   let productId=selectedProducts.join(',');
    //      $("#btn_delete_selected").removeClass("d-none");
    //      $("#btn_delete_selected").attr("product-id",productId);
    //  }else{
    //   $("#btn_delete_selected").addClass("d-none");
    //  }
    if (selectedProducts.length > 0) {
    let productId = selectedProducts.join(',');
    $("#btn_delete_selected").removeClass("d-none");
    $("#btn_delete_selected").attr("product-id", productId);
} else {
    $("#btn_delete_selected").addClass("d-none");
    $("#btn_delete_selected").attr("product-id", ""); // Reset attribute
}

     console.log(selectedProducts) 
     
  }
  const deleteWithSelected=()=>{
    if(confirm("Do you want to delete")){
      let productId=$("#btn_delete_selected").attr("product-id");
      $.ajax({
        type: "POST",
        url: "{{ route('p.deleteSelect') }}",
        data: {
          id:productId,
        },
        dataType: "json",
        success: function (response) {
           if(response.status==200) {
            window.location.href="{{ route('p.list') }}";
        }
      }
      });
    }
    }
    
  
  </script>
  
@endsection
