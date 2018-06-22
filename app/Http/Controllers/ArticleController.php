<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCat;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {

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
                'description' => $_item['description'],
            ];
        }

        $search_conditions = [
            'kw' => $kw,
            'sort_field' => $sort_field,
            'sort' => $sort,
        ];

        $articlecats = ArticleCat::where(['status' => 1])->orderBy('sort', 'desc')->get();

        return home_view('article.index', compact('articlecats', 'data'));
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
                'title' => $_item['title'],
                'main_image_url' => buildPicUrl($_item['image']),
                'view_count' => $_item['view_count'],
                'video' => $_item['video'],
                'recom' => $_item['recom'],
                'description' => $_item['description'],
            ];
        }

        return renderJSON(['data' => $data, 'has_next' => (count($data) == 5) ? 1 : 0]);
    }
}