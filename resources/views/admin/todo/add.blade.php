<a onclick="addTodo(this)">Add new</a>
<div class="modal fade" id="addTodoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            @if (!$errors->addTodoError->isEmpty())
                <div>
                    <ul>
                        @foreach ($errors->addTodoError->all() as $error)
                            <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('admin.addTodo')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Todo</h4>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class='col-sm-12 '>
                            <div class='well' id="editTodoModal-body">
                                <div class="form-group row">
                                    <label id="todoId"  for="todo_title" class="col-2 col-form-label">Title</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text"   name="todo_title">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-search-input" class="col-2 col-form-label">Description</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="text"  name="todo_body" id="example-search-input">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="example-email-input" class=" col-form-label">Assign to:</label><br>
                                   @foreach($admin as $a)
                                <?php  $images= DB::table('basic_infos')->where('user_id', $a->id)->get(); ?>
                                        <div class="col-md-2">
                                        <input type="radio" name="assigned_to" value="{{$a->id}}">
                                        
                                       @foreach($images as $image)    
                                           @if($image->user_image==null)
                                           <img src="/assets/img/admin.svg">
                                           @else
                                            <img class="img-circle" style="width: 64px;
height: 63px;" src="{{$image->user_image}}">
                                           @endif
                                           
                                      
                                       @endforeach 
                                        </div>         
                                   @endforeach
                                </div>

                                <div class="form-group row">
                                    <label for="example-url-input" class="col-2 col-form-label">Due date:</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="flatpickr" placeholder="Choose date"  name="due_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-primary" >Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>