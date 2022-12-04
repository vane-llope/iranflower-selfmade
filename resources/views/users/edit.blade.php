<x-layout>
    <x-form :formInputs="$formInputs" :record="$record"  :action="$path">
        <select name="role" class="form-select" aria-label="Default select example">
          
            @if($selectedrole == null)
            <option value="0" selected>no role</option>
            @else
            <option selected value="{{$selectedrole->id}}">{{$selectedrole->name}}</option>  
            @endif

            @if($accessRole)
            <option value="0" >no role</option>
            @foreach($roles as $role)
            <option value="{{$role['id']}}">{{$role['name']}}</option>
            @endforeach
            @endif

          </select>
    </x-form>
    </x-layout>



    