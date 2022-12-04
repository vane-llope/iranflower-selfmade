<x-layout>
    <x-form :formInputs="$formInputs" :record="$record"  :action="$path">
        <div class=" mb-3">
            <label for="floatingInput">password</label>
            <input type="password" name="password" class="form-control" id="floatingInput" >
            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror
          </div>
    </x-form>
    </x-layout>