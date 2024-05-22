@extends('layouts.admin')
@section('content')
<div class=" p-6 py-20">
    @foreach ($brands as $brand )

    <p>{{$brand}}</p>
    @endforeach
</div>
@endsection
