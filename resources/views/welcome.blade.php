@extends('layouts.admin')

@section('pageTitle', 'Home page')

@section('pageContent')
<div class="container">
    <div class="card row d-flex justify-content-center align-items-center progress" style="height: 70vh;">
        <div class="col-md-8 ">
            <h1 class="text-center text-focus-in text-color-animate text-uppercase fw-bolder " style="font-size: 100px;">Uvagram</h1>
            <h4 class="text-center bounce-bottom"><a href="{{ route('login')}}">Effettua il Login</a></h4>
        </div>
    </div>
</div>
@endsection
