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
        //ログインしているユーザーの情報を先にとってきて
        $user = \Auth::user();

        //ホームに来たときにメモの一覧を取得したい
        //モデルからメモ一覧をここ（コントローラー）に持ってきてViewni渡せる様にしたい
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->orderBy('updated_at','DESC')->get();
        //DBnの中からデータを絞り込む（今回に至ってはメモを持ってくる）
        //ユーザーを限定するためにいる
        //表示するデータは「ユーザーIDと一致したもの、かつ（さらにwhereで絞り込む）statusが1のもの
        //ステータスは論理削除のこと。statusの値によって削除されているかアクティブなのか判断する。万が一削除しても復活できる様にする
        //orderByで並び方の指定ができる。データベースの値から指定することができる。
        //テーブルから更新された順（updated_at）を取得してくる。昇順はASC,DESCは降順。
        return view('home',compact('user','memos'));
        
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
