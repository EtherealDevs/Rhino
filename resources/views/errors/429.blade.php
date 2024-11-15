@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
<div style="text-align: center; margin-top: 50px;">
    <h1 style="font-size: 4rem; color: #ff0000;">Servicio No Disponible</h1>
    <p style="font-size: 1.5rem; color: #666;">
        Lo sentimos, el servicio está temporalmente fuera de línea. Por favor, intenta nuevamente más tarde.
    </p>
</div>
@endsection
