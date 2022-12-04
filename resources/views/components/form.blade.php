@props(['action'])
@props(['formInputs'])
@props(['record'])
@php 
$path = $action;
if($record) {$action = "$action/$record->id";}
else {$action = $path;}
@endphp
<div class="container mt-3">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{ __('Chnage Password') }}</div>

<form method="POST" action="{{$action}}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
    @if($record && !(str_contains($action,'auth')))
    @method('PUT')
    @endif

 @foreach ($formInputs as $formInput)
 @if($formInput['type'] == "textarea")
 <div class="mb-3 ">
  <label for="exampleFormControlTextarea1" class="form-label">{{$formInput['value']}}</label>
  <textarea class="form-control "  name="{{$formInput['name']}}" value=" {{($record) ? $record[$formInput['name']] : old($formInput['name'])}}" id="exampleFormControlTextarea1" rows="3">{{($record) ? $record[$formInput['name']] : old($formInput['name'])}}</textarea>
</div>
@else
  <div class=" mb-3">
    <label for="floatingInput">{{$formInput['value']}}</label>
    <input type="{{$formInput['type']}}" name="{{$formInput['name']}}" value=" {{($record) ? $record[$formInput['name']] : old($formInput['name'])}}" class="form-control" id="floatingInput" >
   
    @error( $formInput['name'])
        <p class="text-danger">{{$message}}</p>
    @enderror
  </div>
  @endif
 @endforeach
 {{$slot}}
  <button type="submit" class="btn btn-danger mt-3 w-100">Submit The Form</button>
    </div>
</form>
</div>
</div>
</div>
</div>