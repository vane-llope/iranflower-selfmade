@props(['items'])
@props(['path'])
@props(['permision'])
<table class="table table-hover text-center">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Show</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
     @foreach ($items as $key=>$item)   
      <tr>
        <th scope="row">{{$key+1}}</th>
        <td>{{$item['name']}}</td>
        <td><a href="{{$path}}/{{$item['id']}}" class="nav-link text-dark">Show</a></td>
        <td>
          @if(str_contains($permision, 'u'))
          <a href="{{$path}}/{{$item['id']}}/edit" class="nav-link text-dark">Edit</a>
          @else <p>Not Allowed</p>
          @endif
        </td>
        <td>
          @if(str_contains($permision, 'r'))
           <form method="POST" action="{{$path}}/{{$item->id}}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn">Delete</button>
       </form>
      @else
      <p>Not Allowed</p>
      @endif
      </td>
      </tr>
      @endforeach
    </tbody>
  </table>