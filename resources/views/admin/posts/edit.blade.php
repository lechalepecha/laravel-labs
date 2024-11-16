@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Изменить пост</h1>
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
            <h3 class="card-title">Пост "{{ $post->title}}"</h3>
        </div>


        <form role="form" method="post" action="{{ route('posts.update', ['post' => $post->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Название</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"  id="title" value="{{ $post->title}}">
                </div>

                <div class="form-group">
                  <label for="description">Цитата</label>
                  <textarea class="form-control" name="description" id="description" rows="5">{{$post->description}}</textarea>
                </div>

                <div class="form-group">
                  <label for="content">Наполнение</label>
                  <textarea class="form-control" name="content" id="content" rows="5">{{$post->content}}</textarea>
                </div>

                <div class="form-group">
                  <label for="category_id">Категория</label>
                  <select class="form-control col-sm-3" id="category_id" name="category_id" data-placeholder="Выберите категорию">
                    @foreach ($categories as $k => $v)
                      <option value="{{ $k }}" @if ($k==$post->category_id) selected @endif>{{ $v }}</option>            
                    @endforeach  
                  </select>
                </div> 

                <div class="form-group">
                  <label for="tags">Теги</label>
                  <select class="select2 col-sm-2" name="tags[]" multiple="multiple" id="tags" data-placeholder="Выберите теги">
                    @foreach ($tags as $k => $v)
                      <option value="{{ $k }}" @if (in_array($k, $post->tags->pluck('id')->all())) selected @endif>{{ $v }}</option>            
                    @endforeach  
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="thumbnail">Изображение</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="thumbnail" id="thumbnail">
                      <label class="custom-file-label" for="thumbnail">Выберите изображение</label>
                    </div>
                  </div>
                  <div>
                    <img src="{{$post->getImage()}}" alt="" class="img-thumbnail mt-2"></div>
                  </div>
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