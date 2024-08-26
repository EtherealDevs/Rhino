@extends('layouts.admin')
@section('content')
    <div class=" p-6">
        <div class="p-6 mt-24 bg-white rounded-xl overflow-scroll">
            <div class="flex justify-between w-full mb-5">
                <div class="justify-start">
                    <h2 class="font-josefin font-bold italic text-2xl">
                        Roles Y Permisos
                    </h2>
                </div>
            </div>

            <div class="">
                <div class="">
                    <h3 class="font-bold text-black text-xl italic mt-12">Usuario: <p
                            class="font-bold text-black text-lg italic">{{ $user->name }}</p>
                    </h3>
                    <h2 class="mt-6">Lista de Roles</h2>
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @foreach ($roles as $role)
                            <div class="inline-flex items-center">
                                <label class="relative flex cursor-pointer items-center rounded-full p-3">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-blue-300 checked:bg-blue-300 checked:before:bg-blue-300 hover:before:opacity-10"
                                        id="role-{{ $role->id }}" @if ($user->roles->first())
                                            @checked(true)
                                        @endif>
                                    <p class="ml-4">
                                        {{ $role->name }}
                                    </p>
                                </label>
                            </div>
                        @endforeach

                        <br>
                        <button type="submit" class="bg-blue-500 mt-12 rounded-xl p-2 px-4">
                            <p class="text-white font-bold">
                                Asignar rol
                            </p>
                        </button>
                    </form>

                </div>
            </div>
        </div>



    </div>
@endsection
