<div class="col-md-8">
    <div class="panel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-10">
                    <h3 class="panel-title">Brands</h3>
                </div>
                <div class="col-md-2">
                    <button onclick="addBrandModal(this)" type="button" style="background-color: #00AAFF; margin-left: -8px; padding: 2px" class="btn btn-lg btn-primary">Add new </button>
                </div>
                @include('admin.categoriesAndBrand.addBrand')
            </div>
        </div>
        <div class="panel-body">
            <ul id="brandMessage">

            </ul>
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
                        <?php

                        $old_date = $b->in_market_from;
                        $old_date_timestamp = strtotime($old_date);
                        $new_date = date('F d, Y ', $old_date_timestamp);
                        ?>
                        <td>{{$new_date}}</td>
                        <td id="actionProduct">
                            <a data-id="{{$b->id}}" style="color: mediumseagreen" onclick="editBrand(this)" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a data-id="{{$b->id}}" onclick="deleteBrand(this)" style="color: red"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @include('admin.categoriesAndBrand.editBrandModal')
            </table>
        </div>
    </div>
</div>