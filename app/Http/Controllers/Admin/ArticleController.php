<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index($page=1) {
        $data = [
            'articles'=>Article::with('user', 'category')->orderBy('created_at', 'desc')->skip(($page-1)*10)->take(10)->get(),
            'nowpage'=>$page,
            'allpage'=>ceil(Article::all()->count() / 10),
        ];
        if($page > $data['allpage']) abort(404);
        return view('admin.articles.index')->with('data', $data);
    }
}
