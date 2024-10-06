<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;

use App\Models\History;

use Carbon\Carbon;

class profileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        
        
        $this->validate($request, Profile::$rules);
        $profile = new Profile;// 新たなプロフィール情報の作成
        $form = $request->all();
        
        
        unset($form['_token']);
        
        
        $profile->fill($form);// 入力情報の反映
        $profile->save();// データベーステーブルにレコードを保存（インサート）する

        return redirect('admin/profile/');// 指定のＵＲＬに移動する
        //               ^^^^^^^^^^^^^^^^^^^^ ココに移動してね
    }
    
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
            if ($cond_title != '') {
                $posts = Profile::where('title', $cond_title)->get();
            } else {
                $posts = Profile::all();
            }
            return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    
    public function edit(Request $request)
    {
        
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        unset($profile_form['_token']);
        
        $profile->fill($profile_form)->save();
        
        // PHP/Laravel 12 課題
        // $history = new History();
        // $history->profile_id = $profile->id;
        // $history->edited_at = Carbon::now();
        // $history->save();
        
        
        return redirect('admin/profile/');
    }
    
    // 以下を追記
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $profile = Profile::find($request->id);
        
        // 削除する
        $profile->delete();
        
        return redirect('admin/profile/');
    }
}
