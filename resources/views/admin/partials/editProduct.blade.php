<div class='row'>
    <div class='col-sm-12 '>
        <div class='well' id="edit-form-info">



        </div>
    </div>
</div>
<script id="edit-form-modal" type="text/x-handlebars-template">

    <form   id="editProfductform" class="text-left">
    <input id="id" data-id="@{{ info.id }}" type="hidden" name="_token" value="{{csrf_token()}}">
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label for='title'>Title</label>
                <input type='text' name='title' value="@{{ info.title }}" class='form-control' />
            </div>
            <div class='form-group'>
                <label for='price'>Price</label>
                <input type='number' min="0" name='price' value="@{{ info.price }}" class='form-control' />
            </div>
            <div class='form-group'>
                <div class="row">
                    <div class="col-sm-6">
                        <label for='brand_id'>Brand</label>
                        <select name='brand_id' class='form-control'>
                            @{{#each brand.brand}}

                            <option value="@{{ this.id }}">@{{ this.brand_name }}</option>

                            @{{/each}}
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for='category_id'>Category</label>
                        <select name='category_id' class='form-control'>
                            @{{#each category.category}}
                            <option value="@{{ this.id }}">@{{ this.category_name }}</option>

                            @{{/each}}
                        </select>
                    </div>
                </div>
            </div>
            <div class='form-group'>
                <div class="row">
                    <div class="col-sm-6">
                        <label for='number_of_products'>Number of products</label>
                        <input type="number" min="0" value="@{{ info.number_of_product }}" class="form-control" name="number_of_products">
                    </div>
                    <div class="col-sm-6">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="imgInp" class="form-control">
                    </div>
                </div>
            </div>
            <fieldset class="form-group">
                <legend>Is sold</legend>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-control form-check-input" name="is_sold" id="optionsRadios1" value="option1" checked>
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-control form-check-input" name="is_sold" id="optionsRadios2" value="option2">
                        No
                    </label>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class='col-sm-12'>


            <div class='form-group'>
                <label for='message'>Description</label>
                <textarea class='form-control' name='description' rows='10'>@{{ info.description }}</textarea>
            </div>

            <div class='text-right'>

                <a class='btn btn-primary' onclick="updateProductInfo(this)">Save</a>
            </div>
        </div>
    </div>
    </form>
</script>


<script>

    function updateProductInfo(trigger) {
        var product = [];
        var trigger = $(trigger),
            container = trigger.parents('#editProfductform'),
            id = container.find('#id').attr('data-id');

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
                product.push(eachPro);
            }
        });
        param = {
            "_token": "{{ csrf_token() }}",
            id : id,
            product:product
        };


        $.ajax({
            url: "/admin/product/saveUpdate",
            method: "post",
            data: param,
            dataType: "json",
            success: function (res) {


            }
        })


    }



</script>