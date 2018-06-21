<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\NewsCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{

    public function index()
    {
        $newscats = NewsCat::orderBy('sort', 'desc')->get();
        $news = News::orderBy('sort', 'desc')->orderBy('id', 'desc')->paginate('20');

        return admin_view('news.index', compact('news', 'newscats'));
    }


    public function create()
    {
        $newscats = NewsCat::orderBy('sort', 'desc')->get();

        return admin_view('news.show', compact('newscats'));
    }


    public function store(Request $request)
    {
        $newscat_id = $request->get('newscat_id', 0);
        $description = $request->get('description');
        $video = $request->get('video');
        $image = $request->get('image');
        $title = $request->get('title');
        $tags = $request->get('tags');
        $content = $request->get('content');
        $news = new News();
        $news->newscat_id = $newscat_id;
        $news->description = $description;
        $news->video = $video;
        $news->image = $image;
        $news->title = $title;
        $news->status = 1;
        $news->tags = $tags;
        $news->content = $content;
        $news->save();

        return ['status' => true];
    }


    public function show(News $news)
    {
        $newscats = NewsCat::orderBy('sort', 'desc')->get();

        return admin_view('news.show', compact('newscats', 'news'));
    }



    public function update(Request $request, News $news)
    {
        $newscat_id = $request->get('newscat_id', 0);
        $description = $request->get('description');
        $video = $request->get('video');
        $image = $request->get('image');
        $title = $request->get('title');
        $content = $request->get('content');
        $tags = $request->get('tags');

        $news->newscat_id = $newscat_id;
        $news->description = $description;
        $news->video = $video;
        $news->image = $image;
        $news->title = $title;
        $news->status = 1;
        $news->tags = $tags;
        $news->content = $content;
        $news->save();

        return ['status' => true];
    }


    public function destroy(News $news)
    {
        $news->delete();
        return ['status'=>true];
    }

    public function recom(News $news)
    {
        $news->recom=1;
        $news->update();
        return ['status'=>true];

    }

    public function unrecom(News $news)
    {
        $news->recom=0;
        $news->update();
        return ['status'=>true];

    }

    public function shenhe(News $news)
    {
        $news->status=1;
        $news->update();
        return ['status'=>true];

    }

    public function unshenhe(News $news)
    {
        $news->status=0;
        $news->update();
        return ['status'=>true];

    }

    public function sort(News $news,Request $request)
    {
        $news->sort=$request->sort;
        $news->update();
        return ['status'=>true];

    }
}
