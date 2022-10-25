@extends('layouts.app')

@section('main_content')

<?php
    if (isset($_SESSION['status'])){
?>
    <div class="alert alert-success" role="alert">
    <?php echo $_SESSION['status']; ?>
    </div>
<?php
unset($_SESSION['status']);
}
?>

    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайт: {{ $url->name }}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $url->id }}</td>
                    </tr>
                    <tr>
                        <td>Имя</td>
                        <td>{{ $url->name }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>{{ $url->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 class="mt-5 mb-3">Проверки</h2>
        <form method="post" action="{{ route('urls.checks', $url->id) }}">
            @csrf
            <input type="submit" class="btn btn-primary" value="Запустить проверку">
        </form><br>

        <table class="table table-bordered table-hover text-nowrap">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Код ответа</th>
                    <th>h1</th>
                    <th>title</th>
                    <th>description</th>
                    <th>Дата создания</th>
                </tr>
                @foreach ($url->checks as $url_check)
                    <tr>
                        <td>{{ $url_check->id }}</td>
                        <td>{{ $url_check->status_code }}</td>
                        <td>{{ $url_check->h1 }}</td>
                        <td>{{ $url_check->title }}</td>
                        <td>{{ $url_check->description }}</td>
                        <td>{{ $url_check->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection