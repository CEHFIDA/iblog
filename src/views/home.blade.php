@extends('adminamazing::teamplate')

@section('pageTitle', 'Блог')
@section('content')
    <div class="row">
        <!-- Column -->
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">@yield('pageTitle')</h4>
                    <div class="text-right">
                        <a class="has-arrow" href="{{ route('AdminBlogEditAdd') }}" aria-expanded="false"><i class="fa fa-plus" aria-hidden="true"></i><span class="hide-menu">Добавить запись</span></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Картинка</th>
                                    <th class="text-nowrap">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($news as $oneNews)
                                    <tr>
                                        <td>{{$oneNews->id}}</td>
                                        <td>{{$oneNews->image}}</td>
                                        <td class="text-nowrap">                                            
                                            <form action="{{ route('AdminBlogDeleted', $oneNews->id) }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                 <a href="{{ route('AdminBlogEdit', $oneNews->id) }}" data-toggle="tooltip" data-original-title="Редактировать"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                <button class="btn btn-link" data-toggle="tooltip" data-original-title="Удалить"><i class="fa fa-close text-danger"></i></button>
                                            </form>
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