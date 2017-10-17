@extends('adminamazing::teamplate')

@section('pageTitle', 'Блог')
@section('content')
    <div class="modal fade" id="deleteModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('AdminBlogDelete') }}" method="POST" class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">Вы точно хотите удалить данную запись?</div>
                    <div class="modal-footer">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" value="">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                                            <a href="#deleteModal" class="delete_toggle" data-rel="{{ $oneNews->id }}" data-toggle="modal"><i class="fa fa-close text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <nav aria-label="Page navigation example" class="m-t-40">
                {{ $news->links('vendor.pagination.bootstrap-4') }}
            </nav>
        </div>
        <!-- Column -->    
    </div>
@endsection