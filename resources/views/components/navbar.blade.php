<div class="container mt-2">
    <div class="d-flex justify-content-between">
      <a href="/" class="text-dark nav-link"><h1> Iran Flower </h1></a>  
      <a href="/flowers" class="text-dark nav-link">Flowers </a>  
      <a href="/products" class="text-dark nav-link"> Products </a> 
      <a href="/products/shops" class="text-dark nav-link">Shops</a>
      <!--<a href="/articles" class="text-dark nav-link"> Articles </a> -->
      @auth
      <a class="nav-link text-dark" href="/users/{{auth()->id()}}/edit">edit info</a>
      <a class="nav-link text-dark" href="/users/change-password">Change Password</a>
      <form action="/users/logout" method="POST" >
        @csrf
        <button class="btn btn-danger fw-bold" type="submit">Logout</button>
        </form>
      @else
       <a href="/users/login" class="text-dark nav-link">Login </a> 
      <a href="/users/register" class="text-dark nav-link">Register </a>    
      @endauth
</div>


<div class="container mt-2">
  <div class="d-flex justify-content-between">
    @auth
    <a href="/" class="text-dark nav-link "><p class="h4">Welcome {{auth()->user()->name}}</p></a> 
     <a href="/flowers/manage" class="text-dark nav-link">Manage Flowers </a> 
    <a href="/products/manage" class="text-dark nav-link">Manage Products </a> 
    <a href="/products/manage/all" class="text-dark nav-link">Manage All Products </a>
    <a href="/articles/manage" class="text-dark nav-link">Manage Articles </a> 
    <a href="/roles/manage" class="text-dark nav-link">Manage Roles </a> 
    <a href="/users/manage" class="text-dark nav-link">Manage Users </a> 
     @endauth
</div>