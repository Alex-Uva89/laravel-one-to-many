@extends('layouts.admin')

@section('pageTitle', 'Index')

@section('pageContent')
    <div class="container">

        <div class="mt-3 d-flex justify-content-between align-items-center">
            <h1 class="text-white">Posts</h1>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4">
            @foreach ($elements as $item)
                <div class="col mb-4">
                    <div class="card m-auto h-100" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $item->image }}" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Creato il: {{ date('d/m/Y', strtotime($item->created_at)) }}</li>
                            <li class="list-group-item">Ultima modifica il: {{ date('d/m/Y', strtotime($item->updated_at)) }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach

        </div>

        {{ $elements->links() }}

    </div>
@endsection
