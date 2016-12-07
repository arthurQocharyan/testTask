@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class = "pull-left col-md-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> {{ Auth::user()->username }}</div>
                    <div class="panel-body">
                        <div class='pull-left col-md-6'>
                            @if(!empty(Auth::user()->avatar))
                                 <img src="/avatar/{{ Auth::user()->avatar }} " style="width: 200px; height: 150px">
                            
                            @else
                                <img src="/avatar/photo.jpg " style="width: 200px; height: 150px">
                            
                            @endif
                           

                        </div>
                        <div class='pull-right col-md-6'>
                            <p>{{ Auth::user()->username}}</p>
                            <p>{{ Auth::user()->firstname}}</p>
                            <p>{{ Auth::user()->lastname}}</p>
                            <p>{{ Auth::user()->email}}</p>
                            <p>{{ Auth::user()->birthday}}</p>
                            <p>{{ Auth::user()->phone_number}}</p>
                        </div>
                    </div>
                     <div class="panel-body">
                        <div class="panel-heading">Add Category</div>
                        {!! Form::open(['url' => ['/addCategory'],'class'=>'form-horizontal']) !!}
                        
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required  autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
        <div class = "pull-right col-md-6">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> Category</div>
                    <div class = 'panel-body'>
                        
                        @foreach($categ['allCateg'] as $allCatg)
                            <a href="{{ url('/category/'.$allCatg["id"].'') }}">
                                <h3>{{$allCatg['title']}}</h3>
                            </a>
                            <spam>{{$allCatg['description']}}</spam>
                        @endforeach
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
