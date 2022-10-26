<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@extends('layouts.layouts')

@section('new_content')

@include('flash::message')

<div class="container">
    <div class="row mt-3">
        <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
            <h1 class="display-3">Анализатор страниц</h1>
            <p class="lead">Бесплатно проверяйте сайты на SEO пригодность</p>
            <form action="{{ route('urls.store') }}" method="POST"
                  class="d-flex justify-content-center">
                @csrf
                <input type="text" name="url[name]" value="" class="form-control form-control-lg" placeholder="https://www.example.com">
                <input type="submit" class="btn btn-primary btn-lg ms-5 px-5 text-uppercase mx-3" value="Проверить">
            </form>
        </div>
    </div>
</div>
@endsection