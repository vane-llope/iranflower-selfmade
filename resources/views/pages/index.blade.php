@php
if (str_contains($path,'product') && !str_contains($path,'shop') ) {
    $multi_image = true;
}else
$multi_image = false;
$searchPath = url()->current();
@endphp

<x-layout>
    <x-search :path="$searchPath"/>
<div class="row">
    <div class="col-sm-9">
        @if(count($posts) == 0)
        <p>No posts Found</p>
        @else
        <div class="row">
        @foreach ($posts as $post)
        <x-card :item='$post' :path="$path" :multi_image="$multi_image"/>
        @endforeach
        </div>
        @endif
        <div class="pagination row">
            <li class="page-item"> {{$posts->links()}} </li>
         </div>
    </div>
    <div class="col-sm-3">
        <x-article-card :items="$articles" :path="$articlepath" />
    </div>
</div>
</x-layout>