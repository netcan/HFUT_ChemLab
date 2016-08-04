<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Article;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systemInfoId = Category::where('name', Category::$base[0])->value('id');
        $noticeId = Category::where('name', Category::$base[1])->value('id');
        return view('index')->with('systeminfo', Article::where('cid', $systemInfoId)->orderBy('created_at', 'desc')->first())->with('notices', Article::where('cid', $noticeId)->orderBy('created_at', 'desc')->take(8)->get());
    }
}
