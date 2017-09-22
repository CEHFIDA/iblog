<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\News_Data;
use Illuminate\Http\Request;
use Xinax\LaravelGettext\LaravelGettext;

class NewsController extends Controller
{

    public function trim_text($input, $length, $ellipses = true, $strip_html = true) {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...';
        }

        return $trimmed_text;
    }


    public function show($id=0)
    {
        if($id != 0)
        {
            $res = News_Data::where('lang', '=', \LaravelGettext::getLocale())->where('news_id', '=', $id)->first();

            return view('blog_view')->with(['news' => $res]);
        }
        $res = News_Data::where('lang', '=', \LaravelGettext::getLocale())->orderBy('created_at', 'desc')->paginate(10);

        foreach ($res as $result)
        {

            if(!file_exists( public_path() . '/img/image/'.$result->news->image)) {
                $result->news->image = "no-image-available.jpg";
            }

            if(strlen($result->text) > 380) {
                $result->text = $this->trim_text($result->text, 380);
            }else {
                $result->text = strip_tags($result->text);
            }
        }

        return view('blog')->with(['news' => $res]);
    }
}
