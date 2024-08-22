@props(['name', 'label', 'model'])
 <div>
     <label for="{{ $name }}">{{ $label }}</label>
     <select name="{{ $name }}" {{ $attributes }}>
        <option disabled value="">Seleccioná una provincia...</option>
        
        @foreach ($model as $item)
        <option value="{{$item->name}}">
            {{$item->name}}
        </option>
        @endforeach
     </select>
     @error($name)
     <div>
          <span class="error">{{ $message }}</span>
     </div>
     @enderror
 </div>