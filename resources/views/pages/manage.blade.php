<x-layout>
    @php
       $searchPath = url()->current();
    @endphp
    <x-search :path="$searchPath"/>
        @if(!str_contains($path,'user'))
        @if(str_contains($permision, 'c'))
        <button  class="btn btn-success my-2">
    <a href="{{$path}}/create" class="nav-link text-light">Create {{$path}} </a> 
    </button>
    @endif
    @endif
     <x-table-manage :items="$items" :path="$path" :permision="$permision" />  
     <div class="pagination row">
        <li class="page-item"> {{$items->links()}} </li>
     </div> 
</x-layout>