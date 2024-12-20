@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Главная</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Тег "{{ $tag->title }}"</h3>
        </div>


        <form role="form" method="post" action="{{ route('tags.update', ['tag' => $tag->id])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Название</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"  id="title" placeholder="{{$tag->title}}">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection