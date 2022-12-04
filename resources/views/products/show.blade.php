<x-layout>
<p>product</p>
@if($product->user_id == auth()->id() || str_contains($allproductswatcher, 'u') ) 
<a class="nav-link text-dark" href="/products/{{$product->id}}/edit">Edit</a>
@endif

@if($product->user_id == auth()->id()  || str_contains($allproductswatcher, 'r') ) 
<form method="POST" action="{{$path}}/{{$product->id}}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn">Delete</button>
 </form>
@endif

<div class="row">
    <div class="col-sm-5 ">
       <x-multi-images :product="$product" />  
    </div>
    <div class="col-sm-7">
        <x-show-card :formInputs="$formInputs" :item="$product" :path="$path" />
    <p class="h3">More Information</p>
<p>Blongs to : {{$product->user->name}}</p>
<p>Company Name : {{$product->user->company}}</p>
<p>The Address : {{$product->user->address}}</p>
    <x-tags :tagsCsv="$product['tags']" :path="$path" />
    </div>
</div>
</x-layout>