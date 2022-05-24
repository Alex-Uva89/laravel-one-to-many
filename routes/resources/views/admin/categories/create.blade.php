@extends('layouts.admin')

@section('pageTitle', 'Crea una nuova categoria')

@section('pageContent')

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-3">
                <h1 class="text-white">Crea una nuova categoria</h1>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-success float-right">Torna alla lista</a>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group text-white">

                <label for="name">Inserisci il nome: </label>
                <input type="text" name="name" id="name" class="form-control mb-3" value="{{ old('name') }}" >
                @error('name')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <label for="description">Inserisci la descrizione: </label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <button type="submit" class="btn btn-success mt-3">Crea</button>
        </form>
    </div>

@endsection
