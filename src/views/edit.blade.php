@extends('adminamazing::teamplate')

@section('pageTitle', 'Редактирование записи')
@section('content')
    <div class="row">
        <!-- Column -->
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">

            <div class="card">

                <!--second tab-->
                <div class="card-block">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form action="{{route('AdminBlogUpdate', $editnews['ru_RU']->news_id)}}" method="POST" class="form-horizontal form-material" id="main" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="image" class="col-md-12">Картинка</label>
                                <div class="col-md-12">
                                    <input type="file" name="image" id="image" value="" placeholder="" class="form-control form-control-line">
                                </div>
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
                                        <label for="title" class="col-md-12">Заголовок</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{$editnews['ru_RU']->title}}" placeholder="" class="form-control form-control-line" name="title['ru_RU']" id="title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="text1" class="col-md-12">Текст</label>

                                        <div class="col-md-12">
                                            <textarea name="text['ru_RU']" id="text1" rows="15" cols="15">{{$editnews['ru_RU']->text}}</textarea>
                                        </div>
                                        {{--<div class="col-md-12">--}}
                                            {{--<input type="text" id="text" name="text['ru_RU']" value="{{$editnews['ru_RU']->text}}" class="form-control form-control-line">--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2" aria-expanded="true">
                                <div class="box-body pad">
                                    <div class="form-group">
                                        <label for="title" class="col-md-12">Заголовок</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{$editnews['en_EN']->title}}" placeholder="" class="form-control form-control-line" name="title['en_EN']" id="title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="text2" class="col-md-12">Текст</label>
                                        <div class="col-md-12">
                                            <textarea name="text['en_EN']" id="text2" rows="15" cols="15">{{$editnews['en_EN']->text}}</textarea>
                                        </div>
                                        {{--<div class="col-md-12">--}}
                                            {{--<input type="text" id="text" name="text['en_EN']" value="{{$editnews['en_EN']->text}}" class="form-control form-control-line">--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Обновить запись</button>
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