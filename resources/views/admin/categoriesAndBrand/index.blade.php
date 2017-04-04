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
                                    <div class="col-md-10">
                                        <h3 class="panel-title">Categories</h3>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" style="background-color: #00AAFF; margin-left: -18px; padding: 2px" class="btn btn-lg btn-primary">Add new </button>
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
                                                <td>{{$c->category_name}}</td>
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
@endsection

@section('script')

@endsection