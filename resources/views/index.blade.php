@extends('layouts.app')

@include('flash::message')

@section('main_content')

@if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif

<div class="container-lg">
    <h1 class="mt-5 mb-3">Сайты</h1>

    <table class="table table-bordered table-hover text-nowrap">
        <tbody>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Дата создания</th>
                <th>Последняя проверка</th>
                </tr>
            @foreach ($urls->all() as $url)          
            <tr>
                <td>{{ $url->id }}</td>
                <td><a href={{ route('urls.show', $url->id)}}> {{ $url->name }}</a></td>
                <td>{{ $url->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection