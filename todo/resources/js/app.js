const { exists } = require("laravel-mix/src/File");

function checkTodo(todoId) {
    console.log(todoId);
    document.querySelector("#select_todo_id").value = todoId;

    document.querySelector("#todo_form").action = "/check";
    document.querySelector("#todo_form").submit();
}



