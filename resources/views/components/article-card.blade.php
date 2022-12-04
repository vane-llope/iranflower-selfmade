@props(['items'])
@props(['path'])
    @foreach ($items as $item)
        <div {{$attributes->merge(['class' => 'text-dark my-3 text-end'])}} >
            <img class="card-img-top w-50 img-thumbnail" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwQlj__Vzq9JHFgIsx3uZUMRV2-qI_kiEbYs6bM5v2w48Qm8gYwq1dwNLjKtwk-FuiWWo&usqp=CAU" alt=""> 
            <a class="text-dark nav-link" href="{{$path}}/{{$item['id']}}">
            <p class="h4">{{$item['name']}}</p></a>
        </div>
    @endforeach