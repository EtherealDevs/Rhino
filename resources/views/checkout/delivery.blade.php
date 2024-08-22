@extends('layouts.app')
@section('content')
    @livewire('DeliveryForm', ['user' => $user], key($user->id))
    {{-- <form method="POST" action="">
        <input type="hidden" name="cart" value="{{session('cart')}}">

        <label for="zip_code">Nombre</label>
        <input type="text" name="zip_code" value="{{$user->name}}">

        <label for="last_name">Apellido</label>
        <input type="text" name="last_name" value="{{$user->last_name}}">
        
        <label for="zip_code">Codigo Postal</label>
        <input type="text" name="zip_code" value="@isset($user->address->zip_code){{$user->address->zip_code}}@endisset">
        
        <label for="province">Provincia</label>
        <input type="text" name="province" value="@isset($user->address->province){{$user->address->province}}@endisset">
        
        <label for="address">Direccion</label>
        <input type="text" name="address" value="@isset($user->address->address){{$user->address->address}}@endisset">

        <label for="street">Calle</label>
        <input type="text" name="street" value="@isset($user->address->street){{$user->address->street}}@endisset">
    </form> --}}
@endsection
@section('js')
@endsection