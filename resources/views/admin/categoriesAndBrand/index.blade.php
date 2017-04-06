@extends('layouts.admin')

@section('title')
    Categories & Brand
@endsection

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Categories and Brands</h3>
                <div class="row">
                    <div class="col-md-5">
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
                                                <td id="cateName">{{$c->category_name}}</td>
                                                <td id="actionProduct">
                                                    <a data-id="{{$c->id}}" onclick="editCategory(this)" style="color: mediumseagreen"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    <a  style="color: red"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
                    <div class="col-md-7">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3 class="panel-title">Brands</h3>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" style="background-color: #00AAFF; margin-left: -8px; padding: 2px" class="btn btn-lg btn-primary">Add new </button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Brand Name</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Started from</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $indexOne=1; ?>
                                    @foreach($brand as $b)
                                    <tr>
                                        <td>{{$indexOne++}}</td>
                                        <td>{{$b->brand_name}}</td>
                                        <td>
                                            <?php
                                                $cate= DB::table('categories')->where('id',$b->category_id)
                                                    ->select('category_name')
                                                    ->first();
                                                echo $cate->category_name;
                                            ?>

                                        </td>
                                        <td>{{$b->brand_description}}</td>
                                        <td>{{$b->in_market_from}}</td>
                                        <td id="actionProduct">
                                            <a  style="color: mediumseagreen"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a  style="color: red"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script id="editCategory-template" type="text/x-handlebars-template">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit category info</h4>
        </div>
        <div class="modal-body" >
            <ul class="errorMsg">
            </ul>
            <div class="form-group">
                <label for="category_name">Category name:</label>
                <input type="text" width="194px" id="category_name" name="category_name" class="form-control" value="@{{ category.category_name }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a type="button" data-id="@{{ category.id }}" onclick="saveUpdateCategory(this)"  class="btn btn-primary">Save changes</a>
        </div>

    </script>
@endsection

@section('script')
    <script>
        function editCategory(trigger) {
            var trigger = $(trigger),
                id = trigger.attr('data-id');
                param = {
                    "_token": "{{ csrf_token() }}",
                    id : id
                };
                $('#editCatModal').modal('show');
            $.ajax({
                url: "/admin/category/edit",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status==200){
                        var source   = $("#editCategory-template").html();
                        var template = Handlebars.compile(source);
                        var context = {'category':res.category};
                        var html    = template(context);
                        $('#editCat-modal-body').html(html);
                    }
                }
            })
        }

        function saveUpdateCategory(trigger) {
            var trigger = $(trigger),
                id = trigger.attr('data-id'),
                category_name= $('#category_name').val();
            param = {
                "_token": "{{ csrf_token() }}",
                id : id,
                category_name: category_name
            };
            $('#editCatModal').modal('show');
            $.ajax({
                url: "/admin/category/saveUpdate",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status==200){
                        $(document).ajaxStop(function(){
                            window.location.reload();
                        });
                    }else{
                        var error=res.error;

                        $.each(error,function (i,v) {
                            $('.errorMsg').prepend(' ');
                            var html =  "<li style='color:red'>"+v+"</li>";
                            $('.errorMsg').prepend(html);
                        });
                    }
                }
            })
        }
    </script>
@endsection