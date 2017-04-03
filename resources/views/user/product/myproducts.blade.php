@extends('layouts.master')

@section('title')
    My products
@endsection
@section('style')
    <link rel="stylesheet" href="">
    <style>
        .panel {
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            -moz-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            -webkit-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            background-color: #fff;
            margin-bottom: 30px;
        }
        .panel .panel-heading,
        .panel .panel-body,
        .panel .panel-footer {
            padding-left: 25px;
            padding-right: 25px;
        }
        .panel .panel-heading {
            padding-top: 20px;
            padding-bottom: 20px;
            position: relative;
        }
        .panel .panel-heading .panel-title {
            margin: 0;
            font-size: 18px;
            font-weight: 300;
        }
        .panel .panel-heading button {
            padding: 0;
            margin-left: 5px;
            background-color: transparent;
            border: none;
            outline: none;
        }
        .panel .panel-heading button i {
            font-size: 14px;
        }
        .panel .panel-body {
            padding-top: 10px;
            padding-bottom: 15px;
        }
        .panel .panel-note {
            font-size: 13px;
            line-height: 2.6;
            color: #777777;
        }
        .panel .panel-note i {
            font-size: 16px;
            margin-right: 3px;
        }
        .panel .right {
            position: absolute;
            right: 20px;
            top: 32%;
        }
        .panel.panel-headline .panel-heading {
            border-bottom: none;
        }
        .panel.panel-headline .panel-heading .panel-title {
            margin-bottom: 8px;
            font-size: 22px;
            font-weight: normal;
        }
        .panel.panel-headline .panel-heading .panel-subtitle {
            margin-bottom: 0;
            font-size: 14px;
            color: #8D99A8;
        }
        .panel.panel-scrolling .btn-bottom {
            margin-bottom: 30px;
        }
        .panel .table > thead > tr > td:first-child,
        .panel .table > thead > tr > th:first-child,
        .panel .table > tbody > tr > td:first-child,
        .panel .table > tbody > tr > th:first-child,
        .panel .table > tfoot > tr > td:first-child,
        .panel .table > tfoot > tr > th:first-child {
            padding-left: 25px;
        }
        .panel .table > thead > tr > td:last-child,
        .panel .table > thead > tr > th:last-child,
        .panel .table > tbody > tr > td:last-child,
        .panel .table > tbody > tr > th:last-child,
        .panel .table > tfoot > tr > td:last-child,
        .panel .table > tfoot > tr > th:last-child {
            padding-left: 25px;
        }

        .panel-footer {
            background-color: #fafafa;
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active"><a href="{{url('/user/my-products')}}">My products</a></li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12">
              @include('user.product.addProduct')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Available Products</h3>
                        <div class="pull-right">
                            <button type="button"  class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                        </div>
                    </div>
                    <div class="panel-body" id="collapseExample">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti doloremque earum fugiat reiciendis sint. Aliquam asperiores deserunt doloribus, earum id ipsam maxime odio officia quas quis temporibus tenetur unde veritatis.
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sold products</h3>
                        <div class="pull-right">
                            <button type="button"  class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                        </div>
                    </div>
                    <div class="panel-body" id="collapseExample">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti doloremque earum fugiat reiciendis sint. Aliquam asperiores deserunt doloribus, earum id ipsam maxime odio officia quas quis temporibus tenetur unde veritatis.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="/assets/js/klorofil.js"></script>
@endsection