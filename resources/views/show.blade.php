<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@extends('layouts.layouts')

@section('new_content')

<?php
if(isset($_SESSION['status'])){
?>
<div class="alert alert-success" role="alert">
    <?php echo $_SESSION[$status];?>
</div>
<?php
unset($_SESSION)
}
?>

<div class="container-lg">
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <h1 class="mt-5 mb-3">Сайт: {{ $users->name }}</h1>
            <form action={{ route('urls.show', $users->id) }} class="d-flex">
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
            @foreach($all as $alls)
            <tr>
                <td>{{ $alls->id }}</td>
                <td>{{ $alls->status_code }}</td>
                <td>{{ Str::limit($alls->h1, 10, "...") }}</td>
                <td>{{ Str::limit($alls->title, 30, "...") }}</td>
                <td>{{ Str::limit($alls->description, 30, "...") }}</td>
                <td>{{ $alls->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection