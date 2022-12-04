<x-layout>
    <h1>Roles</h1>
    <div class="row">
        <div class="col-6">
            @foreach ($formInputs as $formInput)
 <p><span class="fw-bold">{{$formInput['value']}} : </span>{{$item[$formInput['name']]}}</p>
@endforeach
    </div>
        <div class="col-6">
           <p> C => create</p>
           <p>R => remove</p>
            <p> U => update</p>
                <p> D => dispalay (manage view)</p>
        </div>
    </div>

    </x-layout>