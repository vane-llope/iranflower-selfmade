@props(['action'])
@props(['formInputs'])
@props(['record'])
@php 
$path = $action;
if($record) {$action = "$action/$record->id";}
else {$action = $path;}
@endphp
    <div class="container mt-5">

<form method="POST" action="{{$action}}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
    @if($record && !(str_contains($action,'auth')))
    @method('PUT')
    @endif
   
 @foreach ($formInputs as $formInput)
 @if($formInput['value'] == 'Name')
 <div class=" mb-4">
 <label class="mb-4" for="floatingInput">{{$formInput['value']}}</label>
    <input type="{{$formInput['type']}}" name="{{$formInput['name']}}" value=" {{($record) ? $record[$formInput['name']] : old($formInput['name'])}}" class="form-control" id="floatingInput"  >
   
    @error( $formInput['name'])
        <p class="text-danger">{{$message}}</p>
    @enderror
 </div>
 <hr>
    @else
    <div class=" mb-3">
        <label for="floatingInput">{{$formInput['value']}}</label>
        
        <label class="btn">
            <input type="{{$formInput['type']}}"  name="{{$formInput['name']}}" readonly id="intest" value=" {{($record) ? $record[$formInput['name']] : old($formInput['name'])}}" class="form-control d-none" id="floatingInput" >
        </label>

        <input type="hidden"  name="{{ $formInput['name']}}"   value="">
        
        <div class="d-flex justify-content-around">
            <div>
        <label >Create</label>
        <input type="checkbox" class="form-check-input"  value="c"  name="{{ $formInput['name']}}[]"    @checked($record && str_contains( $record[$formInput['name']],'c')) >
       </div> <div>
        <label >Remove</label>
        <input type="checkbox" class="form-check-input" value="r" name="{{$formInput['name']}}[]"    @checked($record && str_contains( $record[$formInput['name']],'r')))>
       </div> <div>
        <label >Update</label>
        <input type="checkbox" class="form-check-input"  value="u" name="{{ $formInput['name']}}[]"    @checked($record && str_contains( $record[$formInput['name']],'u')) >
       </div> <div>
        <label >Display manage table</label>
        <input type="checkbox" class="form-check-input"    value="d"  name="{{ $formInput['name']}}[]"    @checked($record && str_contains( $record[$formInput['name']],'d'))>
       </div>
       
    </div>
    
      </div>
  <hr>
  @endif
 @endforeach
  <button type="submit" class="btn btn-danger mt-3 w-100">Submit The Form</button>
    </div>
</form>
</div>