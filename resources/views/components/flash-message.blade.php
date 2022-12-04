@if (session()->has('message'))
    <div x-data="{show : true}" x-init="setTimeout(()=>show = false,3000)" x-show="show" class="alert alert-success alert-dismissible fade show" role="alert">
       <p>{{session('message')}}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
@endif