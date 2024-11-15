@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message')
    <div style="text-align: center; margin-top: 50px;">
        <h1 style="font-size: 4rem;">Error 402</h1>
        <h1 style="font-size: 4rem;">URL invalida</h1>
        <p style="font-size: 1.5rem; color: #666;">
            Esta direccion no existe, vuelve a intentarlo.
        </p>
    </div>
@endsection
