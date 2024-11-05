@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))
<div style="text-align: center; margin-top: 50px;">
    <h1 style="font-size: 4rem; color: #ff0000;">Servicio No Disponible</h1>
    <p style="font-size: 1.5rem; color: #666;">
        Lo sentimos, el servicio está temporalmente fuera de línea. Por favor, intenta nuevamente más tarde.
    </p>
    <a href="{{ url('/') }}"
        style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">
        Volver al Inicio
    </a>
</div>
@endsection
