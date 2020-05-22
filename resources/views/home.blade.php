@extends('layouts.app')

@section('title')Home @endsection

@section('content')

    <div class=" text-center cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h1 class="masthead-brand">Главная страница</h1><br>
                <p style="font-size: 17px;">Выберите что хотите посмотреть</p>
            </div>
        </header>
        <div class="container mt-5">
            <div class="row text-center">
                <div class="col-md-6">
                    <h3><a href="/books">Все книги</a></h3>
                </div>
                <div class="col-md-6">
                    <h3><a href="/authors">Все авторы</a></h3>
                </div>
            </div>
        </div>
    </div>

@endsection
