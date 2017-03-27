<ul class="errorMsg">
</ul>
<input type="hidden" class="form-control" name="id" value="@{{ info.id }}">
<div class="form-group row">
    <label id="todoId" data-id="@{{ info.id }}" for="todo_title" class="col-2 col-form-label">Title</label>
    <div class="col-10">
        <input class="form-control" type="text"  value="@{{ info.todo_title }}" name="todo_title">
    </div>
</div>

<div class="form-group row">
    <label for="example-search-input" class="col-2 col-form-label">Description</label>
    <div class="col-10">
        <input class="form-control" type="text" value="@{{ info.todo_body }}" name="todo_body" id="example-search-input">
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
    <label for="example-url-input"  class="col-2 col-form-label">Due date:</label>
    <div class="col-10">
        <input type="text" class="form-control" id="flatpickr" placeholder="Choose date" value="@{{ info.due_date }}"  name="due_date">
    </div>
</div>
<script>
  var date=  flatpickr('#flatpickr',{
        dateFormat: 'd.m.Y',
        minDate: "today",
        prevArrow: '&lt;',
        nextArrow: '&gt;'
    });

</script>
