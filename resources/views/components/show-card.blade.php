@props(['formInputs'])
@props(['item'])
@props(['path'])

<div class=" mb-3">
    @foreach($formInputs as $formInput)
    @if($formInput['name']== 'tags')
    <p class="h4">{{$formInput['value']}}</p>
    <x-tags :tagsCsv="$item['tags']" :path="$path" />
   @else
    <p class="h4">{{$formInput['value']}}</p>
    <p>{{$item[$formInput['name']]}}</p>
     @endif
    @endforeach
  </div>