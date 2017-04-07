<div id="addBrand" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" id="addBrand">
        <div class="modal-content" id="modal-body">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Brand</h4>
                </div>
                <div class="modal-body"  >
                    <div class="form-group">
                        <ul style="color: red" id="error">

                        </ul>
                        <label for="">Brand Name:</label>
                        <input type="text" name="brand_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Category:</label>
                        <select class="form-control" name="category_id">
                           @foreach($categories as $c)
                            <option value="{{$c->id}}">{{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea style="max-width: 264px; max-height: 96px;" class="form-control" name="description" id="" cols="10" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="started_from">Started From:</label>
                        <input class="form-control" type="text" id="started_from" name="started_from">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a type="submit"  onclick="addBrand(this)" class="btn btn-primary">Add</a>
                </div>
        </div>
    </div>
</div><!-- /.modal -->
