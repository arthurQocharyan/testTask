@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <div class = "pull-left col-md-12">
            <div class="col-md-12">
                <div class="panel panel-default center">
                    <div class="panel-heading"> {{ $post->title}}</div>
                    <div class="panel-body">
                        <div class='pull-left col-md-4'>
                            <img src="/avatar/{{ $post->avatar }} " style="width: 200px; height: 150px">
                         </div>
                         <div class='pull-left col-md-8'>
                            {!! Form::open(['url' => ['/postEdit/'.$post->id],'class'=>'form-horizontal','enctype'=> "multipart/form-data"]) !!}
                           

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $post->title}}" required autofocus>

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
                                    <input id="description" type="text" class="form-control" name="description" value="{{ $post->description}}"  required autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Category</label>

                                <div class="col-md-6">
                                    <select class="form-control" name='category' value="{{ old('category') }}">
                                        @foreach($categ as $cat)
                                            @if($cat['id'] == $post->categories_id)
                                                <option value="{{$cat["id"]}}" selected="selected">{{$cat['title']}}</option>
                                                @continue
                                            @endif
                                            <option value="{{$cat["id"]}}">{{$cat['title']}}</option>
                                        @endforeach;
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                <label for="avatar" class="col-md-4 control-label">Avatar</label>

                                <div class="col-md-6">
                                    <input id="avatar" type="file" class="form-control" name="avatar" value="{{ old('avatar') }}"  autofocus>

                                    @if ($errors->has('avatar'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Edit Post
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
