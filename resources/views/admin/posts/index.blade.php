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
          <h3 class="card-title">Список постов</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">

            <a href="{{ route('posts.create')}}" class="btn btn-primary mb-3">Добавить пост</a>
            @if ($posts->count())
            
           
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 30px">#</th>
                            <th>Наименования</th>
                            <th>Категория</th>
                            <th>Теги</th>
                            <th>Дата</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($posts as $post)
                    
                        <tr>
                            <td>{{ $post->id}}</td>
                            <td>{{ $post->title}}</td>
                            <td>{{ $post->category->title}}</td>
                            <td>{{ $post->tags->pluck('title')->join(', ')}}</td>
                            <td>{{ $post->created_at}}</td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id)}}" class="btn btn-info btn-sm float-left mr-1">
                                    <i class="fas fa-pencil-alt"></i>       
                                </a>

                                <form action="{{route('posts.destroy', $post->id)}}" method="post" class="float-left">
                                    
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                
            </div>
            
            @else
            <p>Постов пока нет...</p>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

          {{$posts->links()}}  

          <!--Footer-->
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection