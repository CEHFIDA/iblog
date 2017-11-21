@extends('adminamazing::teamplate')

@section('pageTitle', 'Блог')
@section('content')
    @push('scripts')
        <script>
            var route = '{{ route('AdminBlogDelete') }}';
            message = 'Вы точно хотите удалить данную новость?';
        </script>
    @endpush
    @push('display')
        <a class="has-arrow" href="{{ route('AdminBlogEditAdd') }}" aria-expanded="false"><button type="submit" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Создать запись</button></a>
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <div class="clearfix">
                        <h4 class="card-title pull-left">@yield('pageTitle')</h4>
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
                    <div class="alert text-center">
                        <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> На данный момент отсутствуют новости
                    </div>
                    @endif
                </div>
            </div>
            <nav aria-label="Page navigation example" class="m-t-40">
                {{ $news->links('vendor.pagination.bootstrap-4') }}
            </nav>
        </div>
    </div>
@endsection