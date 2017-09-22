<?php

namespace Selfreliance\Iblog;

use App\Http\Controllers\Controller;
use App\Models\News;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use App\Models\News_Data;
use Intervention\Image\ImageManager;

class BlogController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        return view('iblog::home')->with(["news"=>$news]);
    }

    public function destroy($id){
        $ModelNews = News::findOrFail($id);
        $ModelNews_Data = News_Data::where('news_id', '=', $id)->get();
        foreach ($ModelNews_Data as $del) {
            $del->delete();
        }

        $ModelNews->delete();
        return redirect()->route('AdminBlog')->with('status', 'Запись удалена!');
    }


    public function update($news_id, Request $request)
    {
        $messages = [
            "title.'ru_RU'.required" => 'Поле "Заголовок" во вкладке "Russian" не должно быть пустым',
            "text.'ru_RU'.required" => 'Поле "Текст" во вкладке "Russian" не должно быть пустым',
            "title.'en_EN'.required" => 'Поле "Заголовок" во вкладке "English" не должно быть пустым',
            "text.'en_EN'.required" => 'Поле "Текст" во вкладке "English" не должно быть пустым',
        ];

        $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png',
            "title.'ru_RU'" => 'required',
            "text.'ru_RU'" => 'required',
            "title.'en_EN'" => 'required',
            "text.'en_EN'" => 'required',
        ], $messages);

        $ModelsOnDelete = News_Data::where('news_id','=', $news_id)->get();
        foreach ($ModelsOnDelete as $delModel) {
            $delModel->delete();
        }

        $ModelNews_Data_RU = new News_Data;
        $ModelNews_Data_EN = new News_Data;

        $ModelNews_Data_RU->lang = "ru_RU";
        $ModelNews_Data_RU->news_id = $news_id;
        $ModelNews_Data_RU->title = $request->input("title.'ru_RU'");
        $ModelNews_Data_RU->text = $request->input("text.'ru_RU'");
        $ModelNews_Data_RU->save();

        $ModelNews_Data_EN->lang = "en_EN";
        $ModelNews_Data_EN->news_id = $news_id;
        $ModelNews_Data_EN->title = $request->input("title.'en_EN'");
        $ModelNews_Data_EN->text = $request->input("text.'en_EN'");
        $ModelNews_Data_EN->save();

        $ModelNews = News::where('id','=',$news_id)->first();


        if($request->hasFile('image')) {
            $manager = new ImageManager(array('driver' => 'gd'));
            $image = $manager->make($request->file('image'));
            $file = $request->file('image');
            $imageDir = substr(md5(microtime()), mt_rand(0, 30), 2) . '/' . substr(md5(microtime()), mt_rand(0, 30), 2);
            $imageName = uniqid() . "." . $file->getClientOriginalExtension();
            \File::makeDirectory(base_path()."/public/img/image/".$imageDir, $mode = 0777, true, true);
            $image->save(base_path()."/public/img/image/".$imageDir.'/'.$imageName);
            $ModelNews->image = $imageDir.'/'.$imageName;
            $ModelNews->save();
        }

        return redirect()->route('AdminBlogEdit', ["id"=>$news_id])->with('status', 'Запись обновлена!');
    }


    public function addEdit() {
        return view('iblog::add');
    }


    public function add(Request $request) {
        $messages = [
            "title.'ru_RU'.required" => 'Поле "Заголовок" во вкладке "Russian" не должно быть пустым',
            "text.'ru_RU'.required" => 'Поле "Текст" во вкладке "Russian" не должно быть пустым',
            "title.'en_EN'.required" => 'Поле "Заголовок" во вкладке "English" не должно быть пустым',
            "text.'en_EN'.required" => 'Поле "Текст" во вкладке "English" не должно быть пустым',
        ];
        $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png',
            "title.'ru_RU'" => 'required',
            "text.'ru_RU'" => 'required',
            "title.'en_EN'" => 'required',
            "text.'en_EN'" => 'required',
        ], $messages);

        $news = new News;
        $news_data_ru = new News_Data;
        $news_data_en = new News_Data;

        $imageName = null;
        if($request->hasFile('image')) {
            $manager = new ImageManager(array('driver' => 'gd'));
            $image = $manager->make($request->file('image'));
            $file = $request->file('image');
            $imageDir = substr(md5(microtime()), mt_rand(0, 30), 2) . '/' . substr(md5(microtime()), mt_rand(0, 30), 2);
            $imageName = uniqid() . "." . $file->getClientOriginalExtension();
            \File::makeDirectory(base_path()."/public/img/image/".$imageDir, $mode = 0777, true, true);
            $image->save(base_path()."/public/img/image/".$imageDir.'/'.$imageName);
        }else {
            $imageName = 'no-image-available.jpg';
        }

        $news->date = date('Y-m-d');
        $news->image = $imageDir.'/'.$imageName;
        $news->save();

        $news_data_en->news_id = $news->id;
        $news_data_en->title = $request->input("title.'en_EN'");
        $news_data_en->text = $request->input("text.'en_EN'");
        $news_data_en->lang = "en_EN";
        $news_data_en->save();

        $news_data_ru->news_id = $news->id;
        $news_data_ru->title = $request->input("title.'ru_RU'");
        $news_data_ru->text = $request->input("text.'ru_RU'");
        $news_data_ru->lang = "ru_RU";
        $news_data_ru->save();

        return redirect()->route('AdminBlog')->with('status', 'Запись добавлена!');
    }

    public function edit($id)
    {
        $news_data = News_Data::where('news_id', '=', $id)->get();
        //dd($news_data);
        $newsArray = array();
        if($news_data->count() < 2) {
            $news_data = News_Data::where('news_id', '=', $id)->first();
            if($news_data->lang == "en_EN") {
                $newsArray = array('en_EN'=>$news_data, 'ru_RU'=> new News_Data);
                $newsArray['ru_RU']->lang = "ru_RU";
                $newsArray['ru_RU']->news_id = $id;
            }else{
                $newsArray = array('ru_RU'=>$news_data, 'en_EN'=> new News_Data);
                $newsArray['en_EN']->lang = "en_EN";
                $newsArray['en_EN']->news_id = $id;
            }
            return view('iblog::edit')->with(["editnews"=>$newsArray]);
        }
        $newsArray = array($news_data[0]->lang => $news_data[0], $news_data[1]->lang => $news_data[1]);
        return view('iblog::edit')->with(["editnews"=>$newsArray]);
    }
}
