<div class="col-md-4">
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="panel-title">Categories</h3>
                </div>
            </div>
            <div class="row" style="margin-top: 9px">
                <div class="col-md-12">
                    <div class="addCategory">
                        @if ($errors->has('category_name'))
                            <span style="color: red" class="error">{{ $errors->first('category_name') }}</span>
                        @endif
                        <form action="{{route('admin.addCategory')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <input type="text" width="174px" class="form-control " required name="category_name">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit"  style="background-color: #00AAFF; padding: 2px" class="btn btn-lg btn-primary">Add new </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <p id="message">

            </p>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php $index=1; ?>
                <tbody>
                @foreach($categories as $c)
                    <tr>
                        <td>{{$index++}}</td>
                        <td id="cateName">{{ ucfirst($c->category_name)}}</td>
                        <td id="actionProduct">
                            <a data-id="{{$c->id}}" onclick="editCategory(this)" style="color: mediumseagreen"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a data-id="{{$c->id}}"  onclick="deleteCategory(this)" style="color: red"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                <div id="editCatModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content" id="editCat-modal-body">

                        </div>
                    </div>
                </div><!-- /.modal -->
                </tbody>
            </table>
        </div>
    </div>
</div>