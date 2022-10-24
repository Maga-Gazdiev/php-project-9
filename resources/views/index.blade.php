<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@extends('layouts.layouts')

@section('new_content')

<div class="container-lg">
    <h1 class="mt-3 mb-3">Сайты</h1>
    <table class="table table-bordered table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Последняя проверка</th>
                <th>Код ответа</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ route('urls.show', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $all[$user->id]->created_at ?? ''}}</td>
                    <td>{{ $all[$user->id]->status_code ?? ''}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </table>
</div>
@endsection