<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Article;
use App\Paper;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 0;
        foreach(Category::$base as $base) {
            $baseId [] = Category::where('name', Category::$base[$i])->value('id');
            ++$i;
        }
        $data = [
            'baseId' => $baseId,
            'baseInfo' => Category::withCount('articles')->get(),
            'articles_count' => Article::count(),
            'systeminfo' => Article::where('cid', $baseId[0])->orderBy('created_at', 'desc')->first(),
            'notices' => Article::where('cid', $baseId[1])->orderBy('created_at', 'desc')->take(8)->get(),
            'papers_count' => Paper::where('full_score', '<>', 0)->count(),
        ];
//        return view('index')->with('data', $data);
        return view('main.index')->with('data', $data);
    }
}
