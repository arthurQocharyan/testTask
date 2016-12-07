@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <div class = "pull-left col-md-12">
            <div class="col-md-8">
                <div class="panel panel-default center">
                    <div class="panel-heading"> {{ $post->title}}</div>
                    <div class="panel-body">
                        <div class='pull-left col-md-6'>
                            <img src="/avatar/{{ $post->avatar }} " style="width: 200px; height: 150px">
                            @if(Auth::user()->id == $post->user_id)
	                           <div class='userEdit'>
                                {!! Form::open(['url' => ['/delete', $post->id],'class'=>'form-horizontal deletePostForm']) !!}
                                    <button name="{{$post->id}}">Delete</button>
                                {!! Form::close() !!}
	                            	<a href="{{ url('/postEdit/'.$post->id.'') }}">
                                        <button name="{{$post->id}}">Edite</button>
                                    </a>
	                            </div>
                            @endif
                         </div>

                          

                           
                        <div class='pull-right col-md-6'>
                            <p>{{ $post->description}}</p>
                            <p>{{ $post->publish_date}}</p>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
