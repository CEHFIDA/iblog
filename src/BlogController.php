<?php

namespace Selfreliance\Iblog;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use App\Models\News_Data;
use Faker\Provider\File;

class BlogController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        return view('iblog::home')->with(["news"=>$news]);
    }

    public function destroy($id){
        $ModelNews = News::findOrFail($id);
        //dd($ModelNews);
        $ModelNews_Data = News_Data::where('news_id', '=', $id)->get();
        //dd($ModelNews_Data);
        foreach ($ModelNews_Data as $del) {
            $del->delete();
        }
        $image_path = public_path()."/img/image/".$ModelNews->image;
        unlink($image_path);
        $ModelNews->delete();
        return redirect()->route('AdminBlog')->with('status', 'Запись удалена!');
    }


    public function update($id, Request $request)
    {
        $ModelNews_Data = News_Data::where('id', '=', $id)->first();
        $ModelNews = News::where('id','=',$ModelNews_Data->news_id)->first();


        if($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = uniqid().".".$file->getClientOriginalExtension();

            $file->move(base_path()."/public/img/image", $imageName);
            $ModelNews->image = $imageName;
            $ModelNews->save();
        }

        $news_id = $ModelNews_Data->news_id;
        $ModelNews_Data->title = $request->input('title');
        $ModelNews_Data->text = $request->input('text');
        $ModelNews_Data->save();

        return redirect()->route('AdminBlogEdit', ["id"=>$news_id])->with('status', 'Запись обновлена!');
    }


    public function addEdit() {
        $news = array(new News_Data(),new News_Data());
        return view('iblog::add')->with(['news'=>$news]);
    }


    public function add($lang,Request $request) {

        $this->validate($request, [
            'text' => 'required',
            'title' => 'required',
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        $news = new News;
        $news_data = new News_Data;
        $imageName = null;
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = uniqid() . "." . $file->getClientOriginalExtension();
            $file->move(base_path() . "/public/img/image", $imageName);
        }else {
            $imageName = 'no-image-available.jpg';
        }

        $news->date = date('Y-m-d');
        $news->image = $imageName;
        $news->save();

        $news_data->news_id = $news->id;
        $news_data->title = $request->input('title');
        $news_data->text = $request->input('text');
        $news_data->lang = $lang;
        $news_data->save();

        return redirect()->route('AdminBlog')->with('status', 'Запись добавлена!');


    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $news_data = News_Data::where('news_id', '=', $id)->get();


        return view('iblog::edit')->with(["editnews"=>$news_data, "news"=>$news]);
    }
}
