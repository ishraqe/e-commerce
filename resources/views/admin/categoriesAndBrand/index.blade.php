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
    <script id="editBrand-template" type="text/x-handlebars-template" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add New Brand</h4>
        </div>
        <div class="modal-body"  >
            <div class="form-group">
                <ul style="color: red" id="save-error">

                </ul>
                <label for="">Brand Name:</label>
                <input type="text" name="brand_name" value="@{{ brand.brand_name }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Category:</label>
                <select class="form-control" name="category_id">
                    @{{#each category }}
                        <option value="@{{ this.id }}">@{{ this.category_name }}</option>
                    @{{/each }}
                </select>
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea style="max-width: 264px; max-height: 96px;" class="form-control" name="description" id="" cols="10" rows="10"> @{{ brand.brand_description }}</textarea>
            </div>
            <div class="form-group">
                <label for="started_from">Started From:</label>
                <input class="form-control" type="text" id="started_from" name="started_from">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a type="submit" data-id="@{{ brand.id }}"   onclick="saveUpdateBrand(this)" class="btn btn-primary">Add</a>
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

        flatpickr('#started_from',{
            dateFormat: 'd.m.Y',
            prevArrow: '&lt;',
            nextArrow: '&gt;'
        });

        function addBrand(trigger) {
            var brand = [];
            var trigger = $(trigger),
                container = trigger.parents('#addBrand');

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
                    brand.push(eachPro);
                }
            });
            param = {
                "_token": "{{ csrf_token() }}",
                brand:brand
            };


            $('#error').prepend('');
            $.ajax({
                url: "/admin/brand/add",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status == 500){
                        var error=res.error;
                        $.each(error,function (i,v) {
                            var html =  '<li>'+v+'</li>';
                            $('#error').prepend(html);

                        });
                    }else if(res.status==200){
                        $('#addBrand').modal('hide');
                        window.setTimeout(function(){location.reload()},1000)
                    }
                }
            })
        }
        function editBrand(trigger) {
            var trigger = $(trigger),
                id = trigger.attr('data-id');
            param = {
                "_token": "{{ csrf_token() }}",
                id : id
            };
            $('#editBrand').modal('show');
            $.ajax({
                url: "/admin/brand/edit",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status==200){
                        var source   = $("#editBrand-template").html();
                        var template = Handlebars.compile(source);
                        var context = {'category':res.categories,'brand':res.brand };
                        var html    = template(context);
                        $('#edit-brandmodal-body').html(html);
                        flatpickr('#started_from',{
                            dateFormat: 'd.m.Y',
                            defaultDate: res.brand['in_market_from'],
                            prevArrow: '&lt;',
                            nextArrow: '&gt;'
                        });
                    }
                }
            })
        }
        function saveUpdateBrand(trigger) {
            var brand = [];
            var trigger = $(trigger),
                container = trigger.parents('#edit-brand');
            var id=trigger.attr('data-id');
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
                    brand.push(eachPro);
                }
            });
            param = {
                "_token": "{{ csrf_token() }}",
                id:id,
                brand:brand
            };
            $('#error').prepend('');
            $.ajax({
                url: "/admin/brand/saveUpdateBrand",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status == 500){
                        var error=res.error;
                        $.each(error,function (i,v) {
                            var html =  '<li>'+v+'</li>';
                            $('#save-error').prepend(html);

                        });
                    }else if(res.status==200){
                        $('#addBrand').modal('hide');
                        window.setTimeout(function(){location.reload()},1000)
                    }
                }
            })

        }
        function deleteBrand(trigger) {
            var trigger = $(trigger),
                id = trigger.attr('data-id');
            param = {
                "_token": "{{ csrf_token() }}",
                id : id
            };

            $.ajax({
                url: "/admin/brand/delete",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status==500){
                        var message=res.message;
                        var html="<button class='btn btn-danger'>"+message+"</button>";
                        $("#brandMessage").html(html);
                    }else{
                        var message=res.message;
                        var html="<button class='btn btn-success'>"+message+"</button>";
                        $("#brandMessage").html(html);
                        window.setTimeout(function(){location.reload()},3000)
                    }
                }
            })
        }
    </script>
@endsection