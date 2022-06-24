<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    
    public function index() {
        $todos = Todo::orderBy('created_at', 'desc')->get();
        // dd($todos);

        return view('todolist', ['todos' => $todos]);
    }
    public function add(Request $request) {
        Todo::create([
            'content' => $request->content,
            'name' => $request->name

        ]);

        return redirect()->route('todo.init');
   
    }

    public function check(Request $request) {

        // dd($request->all());
        
        $todo = Todo::find($request->select_todo_id);

        if ($todo->check) {
            $todo->check = false;
        } else {
            $todo->check = true;
        }

        $todo->save();
        return redirect()->route('todo.init');
    }

    public $doneTodos; // 完了済リストのプロパティ
    // public $isShowDoneTodos = $todo->check = false;

       public function checkTodo($id, $isFinished)
       {
           $todo = Todo::find($id);
           $todo->done = $isFinished;
           $todo->save();
   
           // チェックがついたデータを再取得
           $todos = $this->check();

           // return で チェックがついたデータをviewで表示する処理をかく
           return view('todolist_done', ['doneTodos' => $todos]);
       }

   
       // 完了済のTodoの表示非表示を切り替え
       public function showDoneTodos()
       {
           // doneカラムがtrueのTodoデータを取得して、$doneTodosという変数に代入

           // TODO：Todoを取得することはできている    
           // TODO：doneカラムがtrueかどうかの判定はできていない    
           // TODO：取得した結果を＄DoneTodosという名前の変数に入れていない
           $todos = Todo::orderBy('created_at', 'desc')->get();
           $todos = \App\Todo::where('check', true )->get();
           
        //    $todos = $DoneTodos;
           // dd($todos);
           
           // TODO：表示することはできている    
           // TODO：使うbladeファイル名が違っている
           // TODO：bladeで使う変数はdoneTodosにしないといけない
           return view('todolist_done', ['doneTodos' => $todos]);

           
           // return で view としてtodolist_doneのbladeを返す。表示するための変数として$doneTodosを渡す
       }
}

