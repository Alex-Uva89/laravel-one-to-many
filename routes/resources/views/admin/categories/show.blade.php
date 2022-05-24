@extends('layouts.admin')

@section('pageTitle', $category->name)

@section('pageContent')
    <div class="container">
        <div class="mt-5 d-flex justify-content-between align-items-center text-white">
            <div class="mb-3">
                <h1>{{ $category->name }}</h1>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-success float-right">Torna alla lista</a>
        </div>

        <div class="row">
            <div class="col-12 text-white">
                <h5>Descrizione:</h5>
                <p>{{ $category->description }}</p>
            </div>

            <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}">Modifica</a>
            <button class="btn btn-danger btn-delete" data-id="{{ $category->id }}">Cancella</button>

        </div>

        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">NO</button>
                    <form method="POST" data-base="{{ route('admin.categories.destroy', 0) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">SI</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
