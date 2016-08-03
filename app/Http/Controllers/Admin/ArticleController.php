<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gate;

class ArticleController extends Controller
{
    public function index() {
        return view('admin.articles.index')->with('articles',Article::with('user', 'category')->orderBy('created_at', 'desc')->paginate(10));
    }
    public function destroy($id) {
        $article = Article::find($id);
        if(Gate::denies('deleteArticle', $article))
            return redirect()->back()->withErrors('你不是管理员或者作者！');
        else {
            $article->delete();
            return redirect()->back();
        }
    }
}
