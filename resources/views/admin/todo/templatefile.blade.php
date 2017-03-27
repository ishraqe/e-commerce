<script id="mytodo-template" type="text/x-handlebars-template">
    <ul class="list-unstyled todo-list">
        @{{#each todo.todo}}
        <li>
            <label class="control-inline fancy-checkbox id"  >
                <input  id="todoId" data-id="@{{ this.id }}" onclick="editStatus(this)"  name="mark-done" type="checkbox"><span></span>
            </label>
            <p>
                <span class="title">@{{ this.todo_title }}</span>
                <span class="short-description">@{{ this.todo_body }}</span>


                <span class="date">@{{this.created_at}}</span>
            </p>
            <div class="controls">
                <a style="color: green"; data-id="@{{this.id}}"  onclick="editTodo(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a style="color: red"; href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
            </div>
        </li>
        @{{/each}}
    </ul>
    <div class="modal fade" id="editTodoModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Todo</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class='col-sm-12 '>
                            <div class='well' id="editTodoModal-body">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-primary" onclick="saveTodo(this)">Save</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</script>

<script id="mydone-template" type="text/x-handlebars-template">
    <ul class="list-unstyled todo-list" >

        @{{#each done.done}}
        <li  id="todoId" data-id="@{{ this.id }}">
            <label class="control-inline fancy-checkbox">
                <input name="mark-done" type="checkbox"><span></span>

            </label>
            <p>
                <span class="title">@{{ this.todo_title }}</span>
                <span class="short-description">@{{ this.todo_body }}</span>


                <span class="date">@{{this.created_at}}</span>
            </p>
            <div class="controls">
                <a style="color: green"; href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <a style="color: red"; href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>

            </div>
        </li>
        @{{/each}}
    </ul>
</script>
<script id="edit-todo-template" type="text/x-handlebars-template">
        @include('admin.partials.editTodo')
</script>
<script id="eachTodo-template" type="text/x-handlebars-template">
    <li id="eachTodo-@{{todo.id}}">
        <label class="control-inline fancy-checkbox id"  >
            <input id="todoId" data-id="@{{todo.id}}" onclick="editStatus(this)"  name="mark-done" type="checkbox"><span></span>
        </label>
        <p>
            <span class="title">@{{todo.todo_title}}</span>
            <span class="short-description">@{{todo.todo_body}}</span>


            <span class="date">@{{todo.created_at}}</span>
        </p>
        <div class="controls">
            <a style="color: green"; data-id="@{{todo.id}}" onclick="editTodo(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a style="color: red";><i class="fa fa-trash" aria-hidden="true"></i></a>

        </div>
    </li>
</script>