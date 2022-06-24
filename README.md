# TODO

練習# todo-app
# todo-app
# todo-app


# FB.1

1.TodoController

■ チェックをつけた後、TODOリスト画面からチェックをつけたデータを非表示にしたい場合はindex()の12行目に記載しているメソッドの条件を見直そう
今　　　：$todos = Todo::orderBy('created_at', 'desc')->get();

修正：$todos = Todo::where('check', true)
　                  ->orderBy('created_at', 'desc')
                   ->get();

こうすることで、リダイレクトしたときにcheckがtrueのものだけ表示されるのでこれで消えてくれると思います。
もし消えなかった場合は、言ってください！

■ 1回で取得できるものは1文で完結させましょう！【showDoneTodos()　70・71行目】
今：$todos = Todo::orderBy('created_at', 'desc')->get();
   $todos = \App\Todo::where('check', true )->get();
   
修正：$todos = Todo::where('check', true)
　                  ->orderBy('created_at', 'desc')
                   ->get();

解説：SQLで上の文を表すと、
今・・・ SELECT * FROM todos ORDER BY created_at DESC;
     SELECT * FROM todos where check = true;
     
修正・・・ SELECT * FROM todos where check = true ORDER BY creared_at DESC;

こんな感じでWHEREとORDER BYは同時に記述できるので、取得する結果が一緒であれば1回の実行で
済むようにしてあげましょう！

■ 不要なコメント・コードは削除しましょう！【使っていないdd()とか】
今はそこまで気にしなくても良いとは思うのですが、相手に見てもらうという観点でお話しさせてもらうと
使っていないコードやコメントは見る人の情報量を余計に増やしてしまい、「これっているの？いらないの？」と
なってしまうので、注意が必要です。
今は課題なので気にしなくて大丈夫だけど、配属されてからこのcodeを見せると
結構言われがちになってしまうので覚えておいてくれると嬉しいです。

2.todolist.blade.php
言えるところはあるけれどさして重要じゃない（結構軽微なもの）のでOK！
