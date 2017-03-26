@extends('layouts.admin')

@section('title')
    Todo
@endsection

@section('content')

    <div class="main-content">

        <div class="row">

            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <a >Add new</a>
                    </div>
                </div>
                <!-- END TODO LIST -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel" id="trigger-area">
                    <div class="panel-heading">
                        <h3 class="panel-title">My To-Do List</h3>
                        <div class="right">
                            <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                        </div>
                    </div>
                    <div class="panel-body" id="todolist">
                        <ul class="list-unstyled todo-list"  >
                            @foreach($myTodo as $m)
                                <li>
                                    <label class="control-inline fancy-checkbox id"  >
                                        <input id="todoId" data-id="{{$m->id}}"  name="mark-done" type="checkbox"><span></span>
                                    </label>
                                    <p>
                                        <span class="title">{{$m->todo_title}}</span>
                                        <span class="short-description">{{$m->todo_body}}</span>
                                        <?php

                                            $old_date = $m->created_at;
                                            $old_date_timestamp = strtotime($old_date);
                                            $new_date = date('F d, Y ', $old_date_timestamp);
                                        ?>

                                        <span class="date">{{$new_date}}</span>
                                    </p>
                                    <div class="controls">
                                        <a style="color: green"; data-id="{{$m->id}}" onclick="editTodo(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a style="color: red";><i class="fa fa-trash" aria-hidden="true"></i></a>

                                    </div>
                                </li>
                            @endforeach()
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
                    </div>
                </div>
                <!-- END TODO LIST -->
            </div>
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Done</h3>
                        <div class="right">
                            <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                        </div>
                    </div>
                    <div class="panel-body" id="donelist">
                        <ul class="list-unstyled todo-list">
                            @if(count($myDone)>0)
                                @foreach($myDone as $m)
                                    <li  id="todoId" data-id="{{$m->id}}">
                                        <p>
                                            <span class="title">{{$m->todo_title}}</span>
                                            <span class="short-description">{{$m->todo_body}}</span>
                                            <?php

                                            $old_date = $m->created_at;
                                            $old_date_timestamp = strtotime($old_date);
                                            $new_date = date('F d, Y ', $old_date_timestamp);
                                            ?>

                                            <span class="date">{{$new_date}}</span>
                                        </p>
                                        <div class="controls">

                                            <a style="color: red"; href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                        </div>
                                    </li>
                                @endforeach()
                            @else
                                <p>No work done to show</p>
                            @endif

                        </ul>
                    </div>
                </div>
                <!-- END TODO LIST -->
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">To-Do List</h3>
                <div class="right">
                    <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                    <button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
                </div>
            </div>
            <div class="panel-body">
                <ul class="list-unstyled todo-list">
                    <li>
                        <label class="control-inline fancy-checkbox">
                            <a  type="checkbox" ></a>
                        </label>
                        <p>
                            <span class="title">Restart Server</span>
                            <span class="short-description">Dynamically integrate client-centric technologies without cooperative resources.</span>
                            <span class="date">Oct 9, 2016</span>
                        </p>
                        <div class="controls">
                            <a style="color: green"; href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a style="color: red"; href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>

                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <!-- END TODO LIST -->
    </div>
    <script id="mytodo-template" type="text/x-handlebars-template">
        <ul class="list-unstyled todo-list" >

            @{{#each todo.todo}}
                <li>
                    <label class="control-inline fancy-checkbox">
                        <input  id="todoId" data-id="@{{ this.id }}" name="mark-done" type="checkbox"><span></span>

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

    <script>

        $('input[type="checkbox"][name="mark-done"]').change(function() {
            if(this.checked) {

                var id = [];
                id.push($(this).attr('data-id'));


                param = {
                    "_token": "{{ csrf_token() }}",
                    id : id
                };

                $.ajax({
                    url: "/admin/todo/status",
                    method: "post",
                    data: param,
                    dataType: "json",
                    success: function (res) {

                        if(res.status==200){

                            var source   = $("#mytodo-template").html();
                            var template = Handlebars.compile(source);
                            var context = {'todo':res.todo};
                            var html    = template(context);
                            $('#todolist').html(html);


                            var source1   = $("#mydone-template").html();
                            var template1 = Handlebars.compile(source1);
                            var context1 = {'done':res.done};
                            var html1    = template1(context1);
                            $('#donelist').html(html1);

                        }
                    }
                })
            }
        });

    </script>
    <script>
        function  editTodo(trigger) {

            var trigger=$(trigger);
            var container=trigger.parents("#todolist");
            var dataId = trigger.attr("data-id");
            $('#editTodoModal').modal('show');

            param = {
                "_token": "{{ csrf_token() }}",
                id : dataId
            };

            $.ajax({
                url: "/admin/edit/todo",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {
                    var title=title;
                    if(res.status==200){

                        var source   = $("#edit-todo-template").html();
                        var template = Handlebars.compile(source);
                        var context = {'info':res.info,'adminInfo':res.adminInfo};
                        var html    = template(context);
                        $('#editTodoModal-body').html(html);

                    }
                }
            })
        }
    </script>
    <script>
        function saveTodo(trigger) {
            var todo = [];
            var trigger=$(trigger);
            var container=trigger.parents("#editTodoModal");
            id = container.find('#todoId').attr('data-id');

            container.find('.form-control').each(function () {
                var triggerThis = $(this),
                    name = triggerThis.attr('name'),
                    type = triggerThis.attr('type'),
                    value = triggerThis.val();
                if(type == 'radio'){
                    if(triggerThis.prop('checked')){
                        var eachPro = {
                            name: name,
                            value: value
                        };
                    }
                } else {
                    var eachPro = {
                        name: name,
                        value: value
                    };
                }
                if(typeof eachPro != 'undefined'){
                    todo.push(eachPro);
                }
            });

            param = {
                "_token": "{{ csrf_token() }}",
                id : id,
                todo:todo
            };

            $.ajax({
                url: "/admin/todo/saveUpdate",
                method: "post",
                data: todo,
                dataType: "json",
                success: function (res) {
                    if(res.status == 500){
                        var error=res.error;
                        $.each(error,function (i,v) {
                            var html =  '<li>'+v+'</li>';
                            container.find('.errorMsg').prepend(html);

                        });


                    }else if(res.status==200){
                        var source   = $("#eachProduct-template").html();
                        var template = Handlebars.compile(source);
                        var context = {product:res.product};
                        var html    = template(context);
                        $('#editModal').modal('hide');
                        $('#eachProduct-'+res.product.id).replaceWith(html);


                    }

                }
            })



        }
    </script>
@endsection