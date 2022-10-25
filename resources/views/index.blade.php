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
                <td><a href="{{ route('urls.show', $url->id)}}"> {{ $url->name }}</a></td>
                <td>{{ $url->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection