@props(['name', 'label'])
 <div>
     <label for="{{ $name }}">{{ $label }}</label>
     <input type="text" name="{{ $name }}" {{ $attributes }}> 
     @error($name)
     <div>
          <span class="error">{{ $message }}</span>
     </div>
     @enderror
 </div>