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
                        <ul class="list-unstyled todo-list" >

                            @foreach($myTodo as $m)
                                <li  id="todoId" data-id="{{$m->id}}">
                                    <label class="control-inline fancy-checkbox">
                                        <input name="mark-done" type="checkbox"><span></span>

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
                                        <a style="color: green"; href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a style="color: red"; href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                    </div>
                                </li>
                            @endforeach()

                        </ul>
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

    <script>
        $('input[type="checkbox"][name="mark-done"]').change(function() {
            if(this.checked) {

                var id = [];



                $('li').click(function(){
                    id.push($(this).attr('data-id'));
                });

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


                            var source   = $("#mydone-template").html();
                            var template = Handlebars.compile(source);
                            var context = {'done':res.done};
                            var html    = template(context);
                            $('#donelist').html(html);

                        }
                    }
                })
            }
        });

    </script>

@endsection