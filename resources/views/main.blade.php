@extends('layouts.app')

@section('title', 'Главная - Анализатор страниц')

@section('content')
<div class="container-lg mt-3 pt-3">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
            <h1 class="display-3">Анализатор страниц</h1>
            <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>
            <form action="/urls" method="post" class="d-flex justify-content-center">
                @csrf
                <input type="text" name="name" value="" class="form-control form-control-lg" placeholder="https://www.example.com">
                <input type="submit" class="btn btn-primary btn-lg ms-3 px-5 text-uppercase mx-3" value="Проверить">
            </form>
        </div>
    </div>
</div>
@endsection