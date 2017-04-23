@extends('layouts.master')

@section('title')
    Search Result
@endsection

@section('content')
    <div class="container">
        <div class="features_items ">
            <h2 class="title ">Search result</h2>
            @if(count($resultData['result']) > 0)
                <div class="alert alert-info" role="alert">
                    <small> {{$resultData['time']}}</small>
                </div>
                <hr>
                <div>
                    @foreach($resultData['result'] as $result)
                        <div class="list-group" style="background-color: whitesmoke; border: 1px solid #37D679">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div id="image-container" >
                                        @if($result->image==null)
                                            <img src="https://d3dqioy2sca31t.cloudfront.net/Projects/cms/production/000/000/008/medium/f0fe28ceb9f2e78917111c19a419993f/101CinqueTerre.jpg" class="img-rounded" alt="Cinque Terre" width="304" height="236">
                                        @else
                                            <image src="{{$result->image}}" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    @if($result->table_name==='products')
                                        <a href="{{route('show',['id'=>$result->id])}}" style="background-color: whitesmoke; border: none; color: grey" class="list-group-item list-group-default active">
                                            <h4 class="list-group-item-heading">{{$result->title}}</h4>
                                            <small>{{$result->about}}</small>
                                        </a>
                                    @elseif($result->table_name==='categories')
                                        <a href="{{route('categories.products',['id'=>$result->id])}}" style="background-color: whitesmoke; border: none; color: grey" class="list-group-item list-group-default active">
                                            <h4 class="list-group-item-heading">{{$result->title}}</h4>
                                            <small>{{$result->about}}</small>
                                        </a>
                                    @elseif($result->table_name==='brands')
                                        <a href="{{route('brands.products',['id'=>$result->id])}}" style="background-color: whitesmoke; border: none; color: grey" class="list-group-item list-group-default active">
                                            <h4 class="list-group-item-heading">{{$result->title}}</h4>
                                            <small>{{$result->about}}</small>
                                        </a>
                                    @elseif($result->table_name==='blogs')
                                        <a href="{{route('blog.single',['id'=>$result->id])}}" style="background-color: whitesmoke; border: none; color: grey" class="list-group-item list-group-default active">
                                            <h4 class="list-group-item-heading">{{$result->title}}</h4>
                                            <small>{{$result->about}}</small>
                                        </a>
                                    @endif
                                    <p style="color: grey" class="list-group-item-text">
                                        <a style="border-radius: 22px;" type="button" class="btn btn-primary">Tag : {{$result->table_name}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {!! $resultData['result']->links()  !!}
                </div>
            @else
                <h2>No result found</h2>

            @endif

        </div>
    </div>

@endsection