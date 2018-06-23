<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCat;
use App\Models\MemberFav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        // 用于分享的参数
        $title = config('盈诺商学院');
        $imgUrl = config('webinfo.imgUrl');
        $desc = config('webinfo.desc');

        $kw = trim(request()->get('kw', ''));
        $category_id = request()->get('category_id', 0);
        $sort_field = trim(request()->get('sort_field', ''));
        $sort = trim(request()->get('sort', ''));
        $sort = in_array($sort, ['asc', 'desc']) ? $sort : 'desc';
        $list = $this->getSearchData();
        $data = [];
        foreach ($list as $_item) {
            $data[] = [
                'id' => $_item['id'],
                'title' => str_limit($_item['title'],32,'...'),
                'news_image_url' => buildPicUrl($_item['image']),
                'view_count' => $_item['view_count'],
                'video' => $_item['video'],
                'recom' => $_item['recom'],
                'created_at' => date('Y-m-d',strtotime($_item['created_at'])),
                'description' => str_limit($_item['description'],48,'...'),
            ];
        }

        $search_conditions = [
            'kw' => $kw,
            'sort_field' => $sort_field,
            'sort' => $sort,
        ];

        $articlecats = ArticleCat::where(['status' => 1])->orderBy('sort', 'desc')->get();

        return home_view('article.index', compact('articlecats', 'data','title','imgUrl','desc'));
    }

    //搜索参数
    private function getSearchData($page_size = 5)
    {
        $kw = trim(request()->get('kw', ''));
        $category_id = request()->get('category_id', '');
        $sort_field = trim(request()->get('sort_field', ''));
        $sort = trim(request()->get('sort', ''));
        $sort = in_array($sort, ['asc', 'desc']) ? $sort : 'desc';
        $p = intval(request()->get("p", 1));


        if ($p < 1) {
            $p = 1;
        }

        $query = Article::where(['status' => 1]);

        if ($category_id) {
            $query->where(['articlecat_id' => $category_id]);
        }



        if ($kw) {
            $where_name = ['title', 'like', '%'.strtr($kw, ['%' => '\%', '_' => '\_', '\\' => '\\\\']).'%'];
            $where_tags = ['tags', 'like', '%'.strtr($kw, ['%' => '\%', '_' => '\_', '\\' => '\\\\']).'%', false];
            $query->where([$where_name])->orWhere([$where_tags]);
        }

        switch ($sort_field) {
            case "view_count":
                $query->orderBy($sort_field, ($sort == "asc") ? 'asc' : 'desc')->orderBy('recom', 'desc')->orderBy('id', 'desc');
                break;
            default:
                $query->orderBy('recom', 'desc')->orderBy('id', 'desc');
                break;
        }
        return $query->offset(  ( $p - 1 ) * $page_size )
            ->limit( $page_size )
            ->get();

    }

    //搜索
    public function search()
    {
        $list = $this->getSearchData();

        $data = [];
        foreach ($list as $_item) {
            $data[] = [
                'id' => $_item['id'],
                'title' => str_limit($_item['title'],32,'...'),
                'main_image_url' => buildPicUrl($_item['image']),
                'view_count' => $_item['view_count'],
                'video' => $_item['video'],
                'recom' => $_item['recom'],
                'created_at' => date('Y-m-d',strtotime($_item['created_at'])),
                'description' => str_limit($_item['description'],48,'...'),
            ];
        }

        return renderJSON(['data' => $data, 'has_next' => (count($data) == 5) ? 1 : 0]);
    }


    //新闻详情
    public function show(Article $article)
    {
        $user_id=\Auth::user()->id;

        // 相关新闻的调用
        $tags = $article->tags;
        $tag = explode(',', $tags);
        $where_tags = '';
        foreach ($tag as $_item) {
            $where_tags = $where_tags."tags like '%$_item%' or ";
        }
        $where = substr($where_tags, 0, strlen($where_tags) - 3);
        $rel_article = Article::where(DB::raw($where))->orderBy('id', 'desc')->where('id', '!=', $article->id)->limit(5)->get();

        $article->view_count=$article->view_count+1;
        $article->update();

        // 用于分享的参数
        $title = $article->title;
        $imgUrl = buildPicUrl($article->image);
        $desc = $article->description;

        //是否收藏
        //$hasfaved= MemberFav::where(['user_id'=>$user_id,'befav_id'=>$article->id,'type'=>'App\Models\News'])->get()->count();
        return home_view('article.show', compact('article', 'rel_article','title','imgUrl','desc'));
    }

}