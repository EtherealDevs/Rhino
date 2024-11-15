@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))
<div style="text-align: center; margin-top: 50px;">
    <h1 style="font-size: 4rem; color: #ff0000;">Servicio No Disponible</h1>
    <p style="font-size: 1.5rem; color: #666;">
        Lo sentimos, el servicio está temporalmente fuera de línea. Por favor, intenta nuevamente más tarde.
    </p>
</div>
@endsection
