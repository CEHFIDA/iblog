<?php

namespace Selfreliance\Iblog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Selfreliance\Iblog\Models\News;
use Selfreliance\Iblog\Models\News_Data;

class BlogController extends Controller
{
    /**
     * Index
     * @return view home with news
    */
    public function index()
    {
        $news = News::orderBy('id', 'desc')->paginate(10);
        
        $news->each(
            function($row)
            {
                $news_data = $row->news_data()->where('lang', \LaravelGettext::getLocale())->select('title', 'text')->first();
                $row->title = $news_data->title;
            }
        );

        return view('iblog::home')->with(["news"=>$news]);
    }

    /**
     * Destroy news
     * @param int $id
     * @return mixed
    */
    public function destroy($id)
    {
        $ModelNews = News::findOrFail($id);
        $ModelNews->news_data()->delete();
        $ModelNews->delete();

        flash()->success( trans('translate-blog::blog.deletedNews') );

        return redirect()->route('AdminBlog');
    }

    /**
     * Update news
     * @param int $news_id
     * @param request $request
     * @return mixed
    */
    public function update($news_id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2',
            'text' => 'required|min:2',
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        if($news_id == 0)
        {
            $ModelNews = new News;
            $ModelNews->image = "";
            $ModelNews->date = "2017-10-11";
            $ModelNews->save();
        }
        else
        {
            $ModelNews = News::find($news_id);
            $ModelNews->news_data()->delete();
        }

        foreach($request->input('title') as $key=>$value)
        {
            if($value != '')
            {
                $model = new News_Data;
                $model->lang = $key;
                $model->title = $value;
                $model->news_id = $ModelNews->id;
                $model->text = $request->input('text')[$key];
                $model->save();
            }
        }

        if($request->hasFile('image'))
        {
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

        flash()->success( ($news_id==0) ? trans('translate-blog::blog.createdNews') : trans('translate-blog::blog.updatedNews') );

        return redirect()->route('AdminBlogEdit', ["id"=>$ModelNews->id]);
    }

    /**
     * addEdit
     * @return view with Post($post), Data($DataLang), Language($Language)
    */
    public function addEdit()
    {
        $Post = false;
        $DataLang = "";
        $Language = \LaravelGettext::getSupportedLocales();

        return view('iblog::edit')->with([
            "Post"=>$Post,
            "Data"=>$DataLang,
            "Language"=>$Language
        ]);
    }

    /**
     * Edit news
     * @param int $id
     * @return view with Post($post), Data($DataLang), Language($Language)
    */
    public function edit($id)
    {
        $Post = News::find($id);
        $Data = $Post->news_data()->get();
        $DataLang = [];
        $Data->each(
            function($row) use (&$DataLang)
            {
                $DataLang[$row->lang] = $row;
            }
        );
        // dump($DataLang);

        $Language = \LaravelGettext::getSupportedLocales();

        return view('iblog::edit')->with([
            "Post"=>$Post,
            "Data"=>$DataLang,
            "Language"=>$Language
        ]);
    }
}