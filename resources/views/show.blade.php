@extends('layouts.layout')

@section('content')
    <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $url->id }}</td>
            </tr>
            <tr>
                <th>Имя</th>
                <td>{{ $url->name }}</td>
            </tr>
            <tr>
                <th>Дата создания</th>
                <td>{{ $url->created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h2 class="mt-5 mb-3">Проверки</h2>
    <form method="post" action="{{ route('urls.checks.store', $url->id) }}">
        @csrf
        <input type="submit" class="btn btn-primary" value="Запустить проверку">
    </form>
    <table class="table table-bordered table-hover text-nowrap mt-3 mb-1">
        <tbody>
        <tr>
            <th>ID</th>
            <th>Код ответа</th>
            <th>h1</th>
            <th>title</th>
            <th>description</th>
            <th>Дата создания</th>
        </tr>
        @foreach($checksUrl as $checkUrl)
            <tr>
                <td>{{ $checkUrl->id }}</td>
                <td>{{ $checkUrl->status_code }}</td>
                <td>{{ Str::limit($checkUrl->h1, 10, "...") }}</td>
                <td>{{ Str::limit($checkUrl->title, 30, "...") }}</td>
                <td>{{ Str::limit($checkUrl->description, 30, "...") }}</td>
                <td>{{ $checkUrl->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection