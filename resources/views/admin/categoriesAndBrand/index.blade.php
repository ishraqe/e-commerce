@extends('layouts.admin')

@section('title')
    Categories & Brand
@endsection

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Categories and Brands</h3>
                <div class="row">
                    @include('admin.categoriesAndBrand.category')
                    @include('admin.categoriesAndBrand.brand')
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

        function deleteCategory(trigger) {
            var trigger = $(trigger),
                id = trigger.attr('data-id');
            param = {
                "_token": "{{ csrf_token() }}",
                id : id
            };

            $.ajax({
                url: "/admin/category/delete",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status==500){
                        var message=res.message;
                        var html="<button class='btn btn-danger'>"+message+"</button>";
                        $("#message").html(html);
                    }else{
                        var message=res.message;
                        var html="<button class='btn btn-success'>"+message+"</button>";
                        $("#message").html(html);
                        window.setTimeout(function(){location.reload()},3000)
                    }
                }
            })
        }

        function addBrandModal() {
            $('#addBrand').modal('show');
        }


    </script>
@endsection