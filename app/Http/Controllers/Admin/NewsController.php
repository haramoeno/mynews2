<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下の1行を追記することで、News Modelが扱えるようになる
use App\Models\News;

class NewsController extends Controller
{
    // 以下を追記
    public function add()
    {
        return view('admin.news.create');
    }
    
    // 以下を追記
    public function create(Request $request)
    {
        // admin/news/createにリダイレクトする
        return redirect('admin/news/create');
    }
}
