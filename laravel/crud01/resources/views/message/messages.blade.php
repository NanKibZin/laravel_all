 @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-item-center p-2" role="alert">
          <h5 class="text-light">{{ Session::get('success') }}</h5>
         <i class="bi bi-bookmark-x p-t-4" data-bs-dismiss="alert" aria-label="Close"></i>
        </div>
        @elseif(Session::has('error') )
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-item-center p-2" role="alert">
          <h5 class="text-light">Invalid Password or Email</h5>
          <i class="bi bi-bookmark-x p-t-4" data-bs-dismiss="alert" aria-label="Close"></i>
        </div>
        @endif
       

