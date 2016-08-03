<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gate;

class ArticleController extends Controller
{

    function __construct() {
        $this->middleware(['auth', 'manage'], ['except' => ['show']]);
    }

    public function index(Request $request) {
        if(Auth::user()->isAdmin() || $request->get('filter') == 'all')
            $v = view('admin.articles.index')->with('articles',Article::with('user', 'category')->orderBy('created_at', 'desc')->paginate(10));
        else if($request->get('cid') != NULL)
            $v = view('admin.articles.index')->with('articles',Article::where('cid', '=', $request->get('cid'))->with('user', 'category')->orderBy('created_at', 'desc')->paginate(10));
        else
            $v = view('admin.articles.index')->with('articles',Article::where('uid', '=', Auth::user()->id)->with('user', 'category')->orderBy('created_at', 'desc')->paginate(10));
        return $v->with('articles_count', Article::all()->count())->with('myArticles_count', Article::where('uid', '=', Auth::user()->id)->count())->with('categories_count', Category::all()->count());

    }
    public function destroy($id) {
        $article = Article::find($id);
        if(Gate::denies('deleteArticle', $article))
            abort(403);
        else {
            $article->delete(); return redirect()->back();
        }
    }
    public function edit($id) {
        $article = Article::find($id);
        if(Gate::denies('opArticle', $article))
            abort(403);
        else {
            $data = [
                'article'=>$article,
                'categories'=>Category::all()
            ];
            return view('admin.articles.edit')->with('data', $data);
        }
    }
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);
        $article = Article::find($id);
        if(Gate::denies('opArticle', $article))
            abort(403);
        $article->title = $request->get('title');
        $article->content = $request->get('content');
        $article->cid = $request->get('category');
        if($article->save())
            return redirect('admin/resources/articles');
        else
            return redirect()->back()->withInput()->withErrors('保存失败！');

    }
    public function create() {
        return view('admin.articles.create')->with('categories', Category::all());
    }
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);
        $article = new Article();
        $article->uid = Auth::user()->id;
        $article->cid = $request->get('category');
        $article->title = $request->get('title');
        $article->content = $request->get('content');
        if($article->save())
            return redirect('admin/resources/articles');
        else
            return redirect()->back()->withInput()->withErrors('新建失败！');
    }
}
