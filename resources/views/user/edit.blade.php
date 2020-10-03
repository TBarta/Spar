@extends('layouts.app')

@section('content')
    <?php
        //create an array of tag names for showing user's tags as checked
        $tag_names = [];
        foreach ($user->tags as $tag) {
            $tag_names[] = $tag->tag;
        }
    ?>

    <form action="{{ action('UserController@update', ['id' => $user->id]) }}" method="post"  enctype = "multipart/form-data">
        @method('put')
        @csrf

        {{--NAME--}}

        <div class="form-group">

            {!! Form::label('name', 'Username', ['class' => 'control-label']) !!}
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}

        </div>

        {{--ADDRESS--}}

        <div class="form-group">

            {!! Form::label('address', 'Address', ['class' => 'control-label']) !!}
            {!! Form::text('address', $user->address, ['class' => 'form-control']) !!}

        </div>

        {{--PHONE--}}

        <div class="form-group">

            {!! Form::label('phone', 'Phone number', ['class' => 'control-label']) !!}
            {!! Form::number('phone', $user->phone, ['class' => 'form-control']) !!}

        </div>

        {{--PHOTO--}}

        <div class="form-group">

                {!! Form::label('Profile Picture', 'Upload a profile picture', ['class' => 'control-label']) !!}
                {!!Form::file("photo" , ['class' => 'form-control-file'])!!}


        </div>

        {{--ABOUT--}}

        <div class="form-group">

            {!! Form::label('about', 'About me', ['class' => 'control-label']) !!}
            {!! Form::textarea('about', $user->about, ['class' => 'form-control']) !!}

        </div>

        {{--TAGS--}}


        <div class="form-group">
            <div class="row">
                @foreach($tags as $tag)
                    <div class="ck-button col-md-3">
                        <label>
                            <input name="tag[]" type="checkbox" value="{{$tag->id}}" {{in_array($tag->tag, $tag_names) ? 'checked' : ''}}><span>{{$tag->tag}}</span>
                        </label>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="form-group">
            {!! Form::submit('Submit') !!}
        </div>

    </form>



@endsection