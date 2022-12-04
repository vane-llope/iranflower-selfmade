<x-layout>
    <div class="row mb-4">
        @if(str_contains($permision,'u'))
        <a class="nav-link text-dark" href="{{$path}}/{{$article->id}}/edit">Edit</a>
        @endif
        @if(str_contains($permision,'r'))
        <form method="POST" action="{{$path}}/{{$article->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete</button>
         </form>
         @endif
        <div class="col-sm-5">
            <img class="w-100" src="../images/no_image.png" alt=""> 
        </div>
        <div class="col-sm-7">
            <x-show-card :formInputs="$formInputs" :item="$article" :path="$path" />
        </div>
    </div>
  
    </x-layout>