@extends('adminamazing::teamplate')

@section('pageTitle', ($Post)?'Редактирование записи':'Добавление записи')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <form action="{{route('AdminBlogUpdate', ($Post != '')?$Post->id:0)}}" method="POST" class="form-horizontal" id="main" enctype="multipart/form-data">
                <div class="card-block p-b-0">                
                    <div class="card-columns el-element-overlay">
                        <div class="card">
                            <div class="el-card-item">
                                @if($Post)
                                    <div class="el-card-avatar el-overlay-1">
                                        <a target="_blank" class="image-popup-vertical-fit" href="/{{$Post->image}}"> <img src="/{{$Post->image}}" alt="user"> </a>
                                    </div>
                                @endif
                                <div class="el-card-content">
                                    <input type="file" name="image" id="image" value="" placeholder="" class="form-control">
                                </div>
                            </div>
                        </div>     
                    </div>     
                </div>
                <ul class="nav nav-tabs customtab" role="tablist">
                    @foreach($Language as $lang)
                        <li class="nav-item"> <a class="nav-link {{ ($loop->first)?'active':NULL}}" data-toggle="tab" href="#tab{{$lang}}" role="tab">{{Config::get('laravel-gettext.supported-locales-pare')[$lang]}}</a> </li>
                    @endforeach                
                </ul>
                <div class="tab-content">                    
                    @foreach($Language as $lang)
                        <div class="tab-pane  p-20 {{ ($loop->first)?'active':NULL}}" id="tab{{$lang}}">
                            <div class="box-body pad">
                                <div class="form-group">
                                    <label for="title{{$lang}}" class="col-md-12">Заголовок ({{Config::get('laravel-gettext.supported-locales-pare')[$lang]}})</label>
                                    <div class="col-md-12">
                                        <input type="text" 
                                        value="{{(isset($DataLang[$lang]))?$DataLang[$lang]->title:NULL}}" 
                                        placeholder="" class="form-control" name="title[{{$lang}}]" id="title{{$lang}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text{{$lang}}" class="col-md-12">Текст ({{Config::get('laravel-gettext.supported-locales-pare')[$lang]}})</label>

                                    <div class="col-md-12">
                                        <textarea class="form-control" name="text[{{$lang}}]" id="text{{$lang}}" rows="15">{!!(isset($DataLang[$lang]))?$DataLang[$lang]->text:NULL!!}</textarea>
                                    </div>
                                </div>                                        
                            </div>                                    
                        </div>
                    @endforeach
                </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">{{($Post)?"Обновить запись":"Добавить запись"}}</button>
                    </div>
                </div>
            </form>          
        </div>
    </div>
@endsection