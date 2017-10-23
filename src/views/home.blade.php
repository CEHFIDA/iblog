@extends('adminamazing::teamplate')

@section('pageTitle', 'Блог')
@section('content')
    <script>
    var route = '{{ route('AdminBlogDelete') }}';
    var message = 'Вы точно хотите удалить данную новость?';
    </script>
    <div class="row">
        <!-- Column -->
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <div class="clearfix">
                        <h4 class="card-title pull-left">@yield('pageTitle')</h4>
                        <div class="text-right pull-right">
                            <a class="has-arrow" href="{{ route('AdminBlogEditAdd') }}" aria-expanded="false"><i class="fa fa-plus" aria-hidden="true"></i><span class="hide-menu">Добавить запись</span></a>
                        </div>
                    </div>
                    @if(count($news) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Заголовок</th>
                                    <th>Картинка</th>
                                    <th>Дата</th>
                                    <th class="text-nowrap">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($news as $oneNews)
                                    <tr>
                                        <td>{{$oneNews->id}}</td>
                                        <td>{{$oneNews->title}}</td>
                                        <td>{{$oneNews->image}}</td>
                                        <td>{{$oneNews->created_at}}</td>
                                        <td class="text-nowrap">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a href="{{ route('AdminBlogEdit', $oneNews->id) }}" data-toggle="tooltip" data-original-title="Редактировать"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                            <a href="#deleteModal" class="delete_toggle" data-id="{{ $oneNews->id }}" data-toggle="modal"><i class="fa fa-close text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-warning text-center">
                        <h4>Новостей не найдено!</h4>
                    </div>
                    @endif
                </div>
            </div>
            <nav aria-label="Page navigation example" class="m-t-40">
                {{ $news->links('vendor.pagination.bootstrap-4') }}
            </nav>
        </div>
        <!-- Column -->    
    </div>
@endsection