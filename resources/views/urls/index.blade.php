@extends('layouts.app')

@section('title', 'Сайты - список всех сайтов')

@section('content')
<div class="container-lg mt-3 pt-3">
<h1 class="mt-5 mb-3">Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Последняя проверка</th>
                    <th>Код ответа</th>
                </tr>
                @foreach ($urls as $url)
                <tr>
                    <td>{{ $url->id }}</td>
                    <td><a href="#">{{ $url->name }}</a></td>
                    <td>{{ $url->updated_at }}</td>
                    <td>200</td>
                </tr>
                @endforeach
            </tbody>
            </table>
            <div>
                <p class="small text-muted">
                    Показано
                    <span class="font-medium">{{ $urls->firstItem() }}</span>
                    из
                    <span class="font-medium">{{ $urls->lastItem() }}</span>
                    / Всего результатов:
                    <span class="font-medium">{{ $urls->total() }}</span>
                </p>
            </div>
            <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
                    {{ $urls->links() }}
            </div>
        </div>
    </div>
@endsection