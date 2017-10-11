<?php

namespace Selfreliance\Iblog;

use App\Http\Controllers\Controller;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Selfreliance\Iblog\Models\News;
use Selfreliance\Iblog\Models\News_Data;
use Intervention\Image\ImageManager;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckAccess');
    }
    
    public function index()
    {
        $news = News::orderBy('id', 'desc')->paginate(10);
        
        $news->each(function($row){
            $news_data = $row->news_data()->where('lang', \LaravelGettext::getLocale())->select('title', 'text')->first();
            $row->title = $news_data->title;
        });

        return view('iblog::home')->with(["news"=>$news]);
    }

    public function destroy($id){
        $ModelNews = News::findOrFail($id);
        $ModelNews->news_data()->delete();
        $ModelNews->delete();
        return redirect()->route('AdminBlog')->with('status', 'Запись удалена!');
    }


    public function update($news_id, Request $request)
    {
        if($news_id == 0){
            $ModelNews = new News;
            $ModelNews->image = "";
            $ModelNews->date = "2017-10-11";
            $ModelNews->save();
        }else{
            $ModelNews = News::find($news_id);
            $ModelNews->news_data()->delete();
        }

        foreach($request->input('title') as $key=>$value){
            if($value != ''){
                $model = new News_Data;
                $model->lang = $key;
                $model->title = $value;
                $model->news_id = $ModelNews->id;
                $model->text = $request->input('text')[$key];
                $model->save();
            }
        }


        if($request->hasFile('image')) {
            
            $manager = new ImageManager(array('driver' => 'gd'));
            $image = $manager->make($request->file('image'));
            $file = $request->file('image');
            $imageDir = substr(md5(microtime()), mt_rand(0, 30), 2) . '/' . substr(md5(microtime()), mt_rand(0, 30), 2);
            $imageName = uniqid() . "." . $file->getClientOriginalExtension();
            \File::makeDirectory(base_path()."/public/files/news/".$imageDir, $mode = 0777, true, true);
            $image->save(base_path()."/public/files/news/".$imageDir.'/'.$imageName);
            $ModelNews->image = "files/news/".$imageDir.'/'.$imageName;
            $ModelNews->save();
        }      

        return redirect()->route('AdminBlogEdit', ["id"=>$ModelNews->id])->with('status', ($news_id==0)?'Запись добавлена':'Запись обновлена!');  
    }


    public function addEdit() {
        $Post = false;
        $DataLang = "";
        $Language = \LaravelGettext::getSupportedLocales();

        return view('iblog::edit')->with(["Post"=>$Post, "Data"=>$DataLang, "Language"=>$Language]);
    }


    public function edit($id)
    {
        $Post = News::find($id);
        $Data = $Post->news_data()->get();
        $DataLang = [];
        $Data->each(function($row) use (&$DataLang){
            $DataLang[$row->lang] = $row;
        });
        // dump($DataLang);

        $Language = \LaravelGettext::getSupportedLocales();

        return view('iblog::edit')->with(["Post"=>$Post, "Data"=>$DataLang, "Language"=>$Language]);
    }
}
