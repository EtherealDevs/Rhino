@extends('layouts.app')
@section('content')
 
<div class="relative flex min-h-screen flex-col justify-center overflow-hidden sm:py-12">
    <div class="bg-white max-w-4xl mx-auto w-full">
      <div class="grid grid-cols-6 h-full">
        <div class="bg-blue-900 p-10 col-span-2">
          <h2 class="mb-10 font-bold text-2xl text-blue-100 before:block before:absolute before:bg-sky-300 before:content[''] relative before:w-20 before:h-1 before:-skew-y-3 before:-bottom-4">Infos Contact</h2>
          <p class="font-bold text-blue-100 py-8 border-b border-blue-700">
            Location Address
            <span class="font-normal text-xs text-blue-300 block">Romada, 16/A, YoYo City, USA</span>
          </p>
          <p class="font-bold text-blue-100 py-8 border-b border-blue-700">
            Phone Number
            <span class="font-normal text-xs text-blue-300 block">+889 (909) 567 87 9</span>
          </p>
          <p class="font-bold text-blue-100 py-8 border-b border-blue-700">
            Email Address
            <span class="font-normal text-xs text-blue-300 block">example@example.com</span>
          </p>
          <p class="font-bold text-blue-100 py-8 border-b border-blue-700">
            Web Address
            <span class="font-normal text-xs text-blue-300 block">zigzagexampl.com</span>
          </p>
  
        </div>
        <div class="bg-blue-50 p-14 col-span-4">
          <h2 class="mb-14 font-bold text-4xl text-blue-900 before:block before:absolute before:bg-sky-300 before:content[''] relative before:w-20 before:h-1 before:-skew-y-3 before:-bottom-4">Entrer en contact</h2>
          <div class="grid gap-6 mb-6 grid-cols-2">
            <div class="flex flex-col">
              <input class="py-4 bg-white rounded-full px-6 placeholder:text-xs" aria-placeholder="Votre nom" placeholder="Votre nom" ></inpu>
            </div>
            <div class="flex flex-col">
              <input class="py-4 bg-white rounded-full px-6 placeholder:text-xs" aria-placeholder="Votre nom" placeholder="Votre prénom" ></inpu>
            </div>
          </div>
          <div class="grid gap-6 mb-6 grid-cols-2">
            <div class="flex flex-col">
              <input class="py-4 bg-white rounded-full px-6 placeholder:text-xs" aria-placeholder="Votre nom" placeholder="Email Adresse" ></inpu>
            </div>
            <div class="flex flex-col">
              <input class="py-4 bg-white rounded-full px-6 placeholder:text-xs" aria-placeholder="Votre nom" placeholder="Sujet" ></inpu>
            </div>
          </div>
          <div class="mb-6">
            <textarea class="w-full rounded-2xl placeholder:text-xs px-6 py-4" placeholder="Votre message ici" name="" id="" rows="8"></textarea>
          </div>
          <div class="flex justify-center">
            <button class="rounded-full bg-blue-900 text-white font-bold py-4 px-6 min-w-40 hover:bg-blue-800 transition-all">Valider</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection