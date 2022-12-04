<x-layout>
<h1>User Information</h1>
@foreach ($formInputs as $formInput)
 <p><span class="fw-bold">{{$formInput['value']}} : </span>{{$user[$formInput['name']]}}</p>
@endforeach
<p><span class="fw-bold">Role : </span>{{$role}}</p>
</x-layout>