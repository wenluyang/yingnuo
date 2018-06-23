<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // 用于分享的参数
        $title = config('盈诺新闻中心');
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
                'title' => $_item['title'],
                'news_image_url' => buildPicUrl($_item['image']),
                'view_count' => $_item['view_count'],
                'video' => $_item['video'],
                'recom' => $_item['recom'],
                'description' => str_limit($_item['description'],54,'...'),
            ];
        }

        $search_conditions = [
            'kw' => $kw,
            'sort_field' => $sort_field,
            'sort' => $sort,
        ];

        $newscats = NewsCat::where(['status' => 1])->orderBy('sort', 'desc')->get();

        return home_view('news.index', compact('newscats', 'data','title','imgUrl','desc'));
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

        $query = News::where(['status' => 1]);

        if ($category_id) {
            $query->where(['newscat_id' => $category_id]);
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
                'title' => $_item['title'],
                'main_image_url' => buildPicUrl($_item['image']),
                'view_count' => $_item['view_count'],
                'video' => $_item['video'],
                'recom' => $_item['recom'],
                'description' => str_limit($_item['description'],54,'...'),
            ];
        }

        return renderJSON(['data' => $data, 'has_next' => (count($data) == 5) ? 1 : 0]);
    }


    //新闻详情
    public function show(News $news)
    {
        $user_id=\Auth::user()->id;

        // 相关新闻的调用
        $tags = $news->tags;
        $tag = explode(',', $tags);
        $where_tags = '';
        foreach ($tag as $_item) {
            $where_tags = $where_tags."tags like '%$_item%' or ";
        }
        $where = substr($where_tags, 0, strlen($where_tags) - 3);
        $rel_news = News::where(DB::raw($where))->orderBy('id', 'desc')->where('id', '!=', $news->id)->limit(5)->get();

        // 用于分享的参数
        $title = $news->title;
        $imgUrl = buildPicUrl($news->image);
        $desc = $news->description;

        //是否收藏
        //$hasfaved= UserFav::where(['user_id'=>$user_id,'befav_id'=>$news->id,'type'=>'App\Models\News'])->get()->count();
        return home_view('news.show', compact('news', 'rel_news','title','desc','imgUrl'));
    }

}