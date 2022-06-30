<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Memoモデルの中にあるインサートゲットID、メモテーブルのカカに入れるという記述
use App\Memo;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        //ログインしているユーザー情報をviewに渡す
        $user = \Auth::user();
        //32票目でとった値を使う
        return view('create', compact('user'));
    }

    public function store(Request $request)
    {
        //Requestでフォームに入力された内容をコントローラーに受け取る

        $data = $request->all();
        //データを送信したり、受信したデータを全て取得する
        // dd($data);
        // POSTされたデータをDB（memosテーブル）に挿入
        // MEMOモデルにDBへ保存する命令を出す

        $memo_id = Memo::insertGetId([
            'content' => $data['content'],
             'user_id' => $data['user_id'], 
            //  'tag_id' => $tag_id,
             'status' => 1
        ]);
        
        // リダイレクト処理
        return redirect()->route('home');
    }
    


}
