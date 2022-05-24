@extends('layouts.admin')

@section('pageTitle', 'Modifica la categoria')

@section('pageContent')

    <div class="container">
        <div class="row mt-3">
            <div class="col-9">
                <h1 class="text-white">Modifica la categoria</h1>
            </div>
            <div class="col-3">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-success float-right">Torna alla lista</a>
            </div>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group text-white">

                <label for="name">Inserisci il nome: </label>
                <input type="text" name="name" id="name" class="form-control mb-3" value="{{ old('name', $category->name) }}" >
                @error('name')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <label for="description">Inserisci la descrizione:</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="alert alert-danger mt-3" role="alert">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <input type="submit" value="Salva modifica" class="btn btn-success mt-3">
        </form>
    </div>

@endsection
