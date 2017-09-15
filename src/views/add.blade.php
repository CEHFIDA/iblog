@extends('adminamazing::teamplate')

@section('pageTitle', 'Добавление записи')
@section('content')
    <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#en_EN" role="tab">English</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#ru_RU" role="tab">Russian</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">

                    <!--second tab-->

                    <div class="tab-pane active" id="en_EN" role="tabpanel">
                        <div class="card-block">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                            <form action="{{route('AdminBlogAdd', 'en_EN')}}" method="POST"  enctype="multipart/form-data" class="form-horizontal form-material">
                                <div class="form-group">
                                    <label for="image" class="col-md-12">Картинка</label>
                                    <div class="col-md-12">
                                        <input type="file" name="image" id="image" value="" placeholder="" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-md-12">Заголовок</label>
                                    <div class="col-md-12">
                                        <input type="text" value="" placeholder="" class="form-control form-control-line" name="title" id="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="text" class="col-md-12">Текст</label>
                                    <div class="col-md-12">
                                        <input type="text" id="text" name="text" value="" class="form-control form-control-line">
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Добавить запись</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="tab-pane" id="ru_RU" role="tabpanel">
                        <div class="card-block">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                            <form action="{{route('AdminBlogAdd', 'ru_RU')}}" method="POST" class="form-horizontal form-material">
                                <div class="form-group">
                                    <label for="image" class="col-md-12">Картинка</label>
                                    <div class="col-md-12">
                                        <input type="file" name="image" id="image" value="" placeholder="" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-md-12">Заголовок</label>
                                    <div class="col-md-12">
                                        <input type="text" value="" placeholder="" class="form-control form-control-line" name="title" id="title">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="text" class="col-md-12">Текст</label>
                                    <div class="col-md-12">
                                        <input type="text" id="text" name="text" value="" class="form-control form-control-line">
                                    </div>
                                </div>
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Добавить запись</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection