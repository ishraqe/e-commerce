<div class="col-md-7">
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="panel-title">Brands</h3>
                </div>
                <div class="col-md-2">
                    <button onclick="addBrandModal(this)" type="button" style="background-color: #00AAFF; margin-left: -8px; padding: 2px" class="btn btn-lg btn-primary">Add new </button>
                </div>
                <div id="addBrand" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">

                        <div class="modal-content" id="modal-body">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add New Brand</h4>
                            </div>
                            <div class="modal-body" >
                                <div class="form-group">
                                    <label for="">Brand Name:</label>
                                    <input type="text" name="brand_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Category:</label>
                                    <select class="form-control">
                                        <option value="cheese">Cheese</option>
                                        <option value="tomatoes">Tomatoes</option>
                                        <option value="mozarella">Mozzarella</option>
                                        <option value="mushrooms">Mushrooms</option>
                                        <option value="pepperoni">Pepperoni</option>
                                        <option value="onions">Onions</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea style="max-width: 264px; max-height: 96px;" class="form-control" name="description" id="" cols="10" rows="10"></textarea>
                                </div>
                                <label for="">Start Year:</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control">
                                            <option value="cheese">Cheese</option>
                                            <option value="tomatoes">Tomatoes</option>
                                            <option value="mozarella">Mozzarella</option>
                                            <option value="mushrooms">Mushrooms</option>
                                            <option value="pepperoni">Pepperoni</option>
                                            <option value="onions">Onions</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control">
                                            <option value="cheese">Cheese</option>
                                            <option value="tomatoes">Tomatoes</option>
                                            <option value="mozarella">Mozzarella</option>
                                            <option value="mushrooms">Mushrooms</option>
                                            <option value="pepperoni">Pepperoni</option>
                                            <option value="onions">Onions</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control">
                                            <option value="cheese">Cheese</option>
                                            <option value="tomatoes">Tomatoes</option>
                                            <option value="mozarella">Mozzarella</option>
                                            <option value="mushrooms">Mushrooms</option>
                                            <option value="pepperoni">Pepperoni</option>
                                            <option value="onions">Onions</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <a type="button"  class="btn btn-primary">Add</a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->
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
                            echo ucfirst($cate->category_name);
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