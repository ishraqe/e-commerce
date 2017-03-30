@extends('layouts.master')

@section('title')
Search Result
@endsection

@section('content')
    <div class="container">
        <div class="features_items">
            <h2 class="title ">Search result</h2>
            <div class="alert alert-info" role="alert">
                <small> {{$resultData['time']}}</small>
            </div>
            <hr>
            <div>
                @foreach($resultData['result'] as $result)
                    <div style="background-color: grey" class="list-group">
                        <a href="#" class="list-group-item active">
                            <h4 class="list-group-item-heading">List group item heading</h4>
                            <p class="list-group-item-text">{{$result->title}}</p>
                        </a>
                    </div>
                @endforeach
            </div>


        </div>
    </div>

@endsection