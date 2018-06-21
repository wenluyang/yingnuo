<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCat;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articlecats = ArticleCat::orderBy('sort', 'desc')->get();
        $articles = Article::orderBy('sort', 'desc')->orderBy('id', 'desc')->paginate('20');

        return admin_view('article.index', compact('articlecats', 'articles'));
    }

    public function create()
    {
        $articlecats = ArticleCat::orderBy('sort', 'desc')->get();
        return admin_view('article.show',compact('articlecats'));
    }

    public function store(Request $request)
    {
        $user_id= $request->get('user_id',0);
        $articlecat_id= $request->get('articlecat_id',0);
        $description= $request->get('description');
        $video= $request->get('video');
        $image= $request->get('image');
        $title= $request->get('title');
        $content= $request->get('content');
        $tags= $request->get('tags');

        $article = new Article();
        $article->user_id=$user_id;
        $article->articlecat_id=$articlecat_id;
        $article->description=$description;
        $article->video=$video;
        $article->image=$image;
        $article->title=$title;
        $article->content=$content;
        $article->tags=$tags;
        $article->save();
        return ['status'=>true];
    }

    public function show(Article $article)
    {
        $articlecats = ArticleCat::orderBy('sort', 'desc')->get();
        return admin_view('article.show',compact('articlecats','article'));
    }

    public function update(Article $article,Request $request)
    {
        $user_id= $request->get('user_id',0);
        $articlecat_id= $request->get('articlecat_id',0);
        $description= $request->get('description');
        $video= $request->get('video');
        $image= $request->get('image');
        $title= $request->get('title');
        $content= $request->get('content');
        $tags= $request->get('tags');


        $article->user_id=$user_id;
        $article->articlecat_id=$articlecat_id;
        $article->description=$description;
        $article->video=$video;
        $article->image=$image;
        $article->title=$title;
        $article->content=$content;
        $article->tags=$tags;

        $article->save();
        return ['status'=>true];
    }

    public function delete(Article $article)
    {
        $article->delete();
        return ['status'=>true];
    }

    public function recom(Article $article)
    {
        $article->recom=1;
        $article->update();
        return ['status'=>true];

    }

    public function unrecom(Article $article)
    {
        $article->recom=0;
        $article->update();
        return ['status'=>true];

    }

    public function shenhe(Article $article)
    {
        $article->status=1;
        $article->update();
        return ['status'=>true];

    }

    public function unshenhe(Article $article)
    {
        $article->status=0;
        $article->update();
        return ['status'=>true];

    }

    public function sort(Article $article,Request $request)
    {
        $article->sort=$request->sort;
        $article->update();
        return ['status'=>true];

    }
}