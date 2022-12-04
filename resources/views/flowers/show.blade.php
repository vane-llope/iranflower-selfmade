<x-layout>
    <div class="row mb-4">
        @auth
        @if(str_contains($permision,'u'))
        <a class="nav-link text-dark" href="{{$path}}/{{$flower->id}}/edit">Edit</a>
        @endif
        @if(str_contains($permision,'r'))
        <form method="POST" action="{{$path}}/{{$flower->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">Delete</button>
         </form>
         @endif
         @endauth
        <div class="col-sm-5">
            <img class="w-100" src="../images/no_image.png" alt=""> 
        </div>
        <div class="col-sm-7">
            <x-show-card :formInputs="$formInputs" :item="$flower" :path="$path" />
        </div>
    </div>
    </x-layout>