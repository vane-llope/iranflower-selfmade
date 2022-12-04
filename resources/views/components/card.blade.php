@props(['item'])
@props(['path'])
@props(['multi_image'])
     <div class="col-sm-3 ">
          <div {{$attributes->merge(['class' => ' text-dark mb-3'])}} >
               <div class="card" >
                    @if($multi_image)
                         <x-multi-images :product="$item" /> 
                    @else
                         <img class="card-img-top w-100 " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwQlj__Vzq9JHFgIsx3uZUMRV2-qI_kiEbYs6bM5v2w48Qm8gYwq1dwNLjKtwk-FuiWWo&usqp=CAU" alt="">   
                    @endif
                    <div class="text-center">
                         <a class="text-dark nav-link" href="{{$path}}/{{$item->id}}">
                         @if(str_contains($path,'shop'))
                              <h5>{{$item->company}}</h5></a>
                         @else
                              <h5>{{$item->name}}</h5></a>
                         @endif
                              <x-tags :tagsCsv="$item->tags" :path="$path" />
                    </div>
               </div>
          </div>
     </div>
 
    