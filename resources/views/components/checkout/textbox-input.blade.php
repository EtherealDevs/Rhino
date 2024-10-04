@props(['name', 'label'])
 <div>
     <label for="{{ $name }}">{{ $label }}</label>
     <textarea name="{{ $name }}" {{ $attributes }}> 
     </textarea>
     @error($name)
     <div>
          <span class="error">{{ $message }}</span>
     </div>
     @enderror
 </div>