@props(['tagsCsv'])
@props(['path'])
@if($tagsCsv)
@php
    $tags = explode(',',$tagsCsv);
 @endphp   
 <div class="d-flex" style="flex-wrap: wrap;">
    @foreach ($tags as $key=>$tag)
  <a  class = 'text-dark nav-link ' href="{{$path}}/?tag={{$tag}}">#{{$tag}}</a> 
  @if(($key+1) %3 == 0)
  <br>
  @endif
  @endforeach 
 </div>
 @endif