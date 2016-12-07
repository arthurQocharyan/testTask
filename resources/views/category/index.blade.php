@extends('layouts.app')
@section('content')
	<div class="container">
    <div class="col-md-12">
        <div class = "pull-left col-md-4">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                        <h2>Category</h2>
                        <a href="{{ url('/addPost') }}">
                                           Add Post
                                        </a> 
                    </div>
                   	<div class="panel-body">
                        @foreach($categ['allCateg'] as $allCatg)
                            @if($selected['0']['id'] == $allCatg["id"])
                                <h3>{{$allCatg['title']}}</h3>
                            @else
                            <a href="{{ url('/category/'.$allCatg["id"].'') }}">
                                <h3>{{$allCatg['title']}}</h3>
                            </a>
                            @endif
                            <spam>{{$allCatg['description']}}</spam>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class = "pull-right col-md-8">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> 
                       <h3> {{$selected['0']['title']}} </h3>
                       <span> {{$selected['0']['description']}} </span>
                    </div>
                    <div class = 'panel-body'>
                        @foreach($posts as $post)
                            <div class="postInfo">
                                <a href="{{ url('/post/'.$post["id"].'') }}">
                                    <div class='userPost'>
                                        <img src="/avatar/{{ $post["avatar"] }} " style="width: 200px; height: 150px">
                                        <h4>{{$post['title']}}</h3>
                                        <span>{{$post['description']}}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection