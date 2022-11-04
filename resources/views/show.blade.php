<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@extends('layouts.layouts')

@section('new_content')

@include('flash::message')

<div class="container-lg">
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap" data-test="url">
            <h1 class="mt-3">Сайт: {{ $users->name }}</h1>
            <form action="{{ route('urls.show', $users->id) }}" class="d-flex">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $users->id }}</td>
                    </tr>
                    <tr>
                        <th>Имя</th>
                        <td>{{ $users->name }}</td>
                    </tr>
                    <tr>
                        <th>Дата создания</th>
                        <td>{{ $users->created_at }}</td>
                    </tr>
                </tbody>
            </form>
        </table>
    </div>
    <h2 class="mt-5 mb-3">Проверки</h2>
    <form method="post" action={{ route('urls.checks', $users->id) }}>
        @csrf
        <input type="submit" class="btn btn-primary" value="Запустить проверку">
    </form>
    <table class="table table-bordered table-hover text-nowrap" data-test="checks">
        <tbody>
            <tr>
                <th>ID</th>
                <th>Код ответа</th>
                <th>h1</th>
                <th>title</th>
                <th>description</th>
                <th>Дата создания</th>
            </tr>
            
            @foreach($all as $alls)
            <tr>
                <td>{{ $alls->id }}</td>
                <td>{{ $alls->status_code }}</td>
                <td>{{ $alls->h1 }}</td>
                <td>{{ $alls->title }}</td>
                <td>{{ $alls->description }}</td>
                <td>{{ $alls->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection