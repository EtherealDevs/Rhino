@extends('layouts.admin')
@section('content')
<div class="pt-20 px-10">
    <h2>Categorias</h2>
    <a href={{route('admin.categories.create')}}>nueva categoria</a>
    @foreach ($categories as $category)
        <p>{{$category}}</p><a href={{ route('admin.categories.edit', $category) }}>edit</a><form action={{ route('admin.categories.destroy', $category) }} method="post">
        @csrf
        @method('delete');
            <button type="submit" onclick="return confirm('Se eliminara')">eliminar</button>
        </form>
        <br/>
    @endforeach

</div>
@endsection
