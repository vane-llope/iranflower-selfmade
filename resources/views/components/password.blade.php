
<div class=" mb-3">
  <label for="floatingInput">password</label>
    <input type="password" name="password" class="form-control" id="floatingInput" >
    @error('password')
        <p class="text-danger">{{$message}}</p>
    @enderror
  </div>


  <div class=" mb-3">
    <label for="floatingInput">confirm password</label>
    <input type="$password" name="password_confirmation" class="form-control" id="floatingInput" >
 
    @error('password_confirmation')
        <p class="text-danger">{{$message}}</p>
    @enderror
  </div>