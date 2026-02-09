@extends('layouts.admin.layout')
@section('title', 'Novo Material')

@section('content')
    <div class="card mt-4 shadow">
        <div class="card-header bg-secondary text-white">
            <a href="{{ route('admin.heritages.index') }}" class="btn btn-outline-light btn-sm" title="Ver Todos">
                <i class="fa-solid fa-list"></i>
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.heritages.store') }}" method="POST">
                @csrf

                @include('forms._formHeritageCreate.index')
            </form>
        </div>
    </div>
@endsection
