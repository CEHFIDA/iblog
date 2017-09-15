@extends('adminamazing::teamplate')

@section('pageTitle', 'Редактирование записи')
@section('content')
    <div class="row">
        <!-- Column -->
        <!-- Column -->
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

                    @foreach($editnews as $editnewsOne)
                        <div class="tab-pane
                                {{$loop->first?"active":null}}
                                " id="{{$editnewsOne->lang}}" role="tabpanel">

                            <div class="card-block">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif

                                <form action="{{route('AdminBlogUpdate', $editnewsOne->id)}}" method="POST" class="form-horizontal form-material" id="main" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="image" class="col-md-12">Картинка</label>
                                        <div class="col-md-12">
                                            <input type="file" name="image" id="image" value="{{$news->image}}" placeholder="" class="form-control form-control-line">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="title" class="col-md-12">Заголовок</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{$editnewsOne->title}}" placeholder="" class="form-control form-control-line" name="title" id="title">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="text" class="col-md-12">Текст</label>
                                        <div class="col-md-12">
                                            <input type="text" id="text" name="text" value="{{$editnewsOne->text}}" class="form-control form-control-line">
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
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection