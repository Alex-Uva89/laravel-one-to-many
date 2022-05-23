@extends('layouts.admin')

@section('pageTitle', 'Index')

@section('pageContent')
    <div class="container">
        @if (session('deleted'))
            <div class="alert alert-warning">{{ session('deleted') }}</div>
        @endif
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <h1 class="text-white">Categorie:</h1>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success float-right">Crea una nuova categoria</a>
        </div>
        <div class="row">
            <div class="col">

                <table class="table table-dark table-hover border border-white">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                            <tr  data-id="{{ $item->id }}">
                                <th class="text-center" scope="row">{{ $item->id }}</th>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.categories.show', $item->id) }}">Apri</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.categories.edit', $item->id) }}">Modifica</a>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-delete">Cancella</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">NO</button>
                    <form method="POST" data-base="{{ route('admin.categories.destroy', '*****') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">SI</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
