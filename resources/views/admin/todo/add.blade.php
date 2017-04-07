<a onclick="addTodo(this)">Add new</a>
<div class="modal fade" id="addTodoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Todo</h4>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-sm-12 '>
                        <div class='well' id="editTodoModal-body">
                            <ul class="errorMsg">
                            </ul>
                            <div class="form-group row">
                                <label id="todoId"  for="todo_title" class="col-2 col-form-label">Title</label>
                                <div class="col-10">
                                    <input class="form-control" type="text"   name="todo_title">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-search-input" class="col-2 col-form-label">Description</label>
                                <div class="col-10">
                                    <input class="form-control" type="text"  name="todo_body" id="example-search-input">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-email-input" class="col-2 col-form-label">Assign to:</label><br>
                                @{{#each adminInfo.adminInfo }}
                                    <label class="radio-inline">
                                        <input type="radio" style="margin-left: -51px;" class="form-control" name="assigned_to" value="@{{ this.id }}"/>
                                        <div class="thumbnail" style="background-color:inherit; border: none"; >
                                            <img style="height: 41px; width: 38px;" src="@{{ this.image }}" title="">
                                            <div class="caption">
                                                <p>@{{ this.name }}</p>
                                            </div>
                                        </div>

                                    </label>
                                @{{/each }}
                            </div>

                            <div class="form-group row">
                                <label for="example-url-input" class="col-2 col-form-label">Due date:</label>
                                <div class="col-10">
                                    <input type="text" class="form-control" id="flatpickr" placeholder="Choose date"  name="due_date">
                                </div>
                            </div>
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