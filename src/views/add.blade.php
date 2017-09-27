@extends('adminamazing::teamplate')

@section('pageTitle', 'Добавление записи')
@section('content')
    <div class="row">
        <!-- Column -->
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">

            <div class="card">

                <!--second tab-->
                <div class="card-block">
                    {{--@if ($errors->any())--}}
                    {{--@foreach ($errors->all() as $error)--}}
                    {{--<div class="alert alert-danger">--}}
                    {{--{{ $error }}--}}
                    {{--</div>--}}
                    {{--@endforeach--}}
                    {{--@endif--}}

                    <form action="{{route('AdminBlogAdd')}}" method="POST" class="form-horizontal" id="main" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="image" class="col-md-12">Картинка</label>
                                <div class="col-md-12">
                                    <input type="file" name="image" id="image" value="" placeholder="" class="form-control">
                                </div>
                                @if($errors->has("image"))
                                    <div class="alert alert-danger">
                                        {{ $errors->first("image") }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Russian</a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">English</a> </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="box-body pad">
                                    <div class="form-group">
                                        <label for="titleRU" class="col-md-12">Заголовок</label>
                                        <div class="col-md-12">
                                            <input type="text" value="" placeholder="" class="form-control" name="title['ru_RU']" id="titleRU">
                                        </div>
                                        @if($errors->has("title.'ru_RU'"))
                                            <div class="alert alert-danger">
                                                {{ $errors->first("title.'ru_RU'") }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="textRU" class="col-md-12">Текст</label>
                                        <div class="col-md-12">
                                            <textarea class="textarea_editor form-control" name="text['ru_RU']" id="textRU" rows="15"></textarea>
                                        </div>
                                        @if($errors->has("text.'ru_RU'"))
                                            <div class="alert alert-danger">
                                                {{ $errors->first("text.'ru_RU'") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <div class="box-body pad">
                                    <div class="form-group">
                                        <label for="titleEN" class="col-md-12">Заголовок</label>
                                        <div class="col-md-12">
                                            <input type="text" value="" placeholder="" class="form-control" name="title['en_EN']" id="titleEN">
                                        </div>
                                        @if($errors->has("title.'en_EN'"))
                                            <div class="alert alert-danger">
                                                {{ $errors->first("title.'en_EN'") }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="textEN" class="col-md-12">Текст</label>
                                        <div class="col-md-12">
                                            <textarea class="textarea_editor1 form-control" name="text['en_EN']" id="textEN" rows="15"></textarea>
                                        </div>
                                        @if($errors->has("text.'en_EN'"))
                                            <div class="alert alert-danger">
                                                {{ $errors->first("text.'en_EN'") }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" id="addNews">Добавить запись</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{--</div>--}}
            </div>
        </div>
    </div>
    <!-- Column -->
    </div>
@endsection