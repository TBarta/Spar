@extends('layouts.app')

@section('content')

    <?php
    //create an array of tag names for showing user's tags as checked
    $tag_names = [];
    foreach (Auth::user()->tags as $tag) {
        $tag_names[] = $tag->tag;
    }
    ?>

    <h1 class="text-center display-3 mt-3 mb-5">Select tags</h1>
    <form action="{{action('SearchController@store')}}" method="post">
        @csrf

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

        <div class="form-group my-5">
            {!! Form::submit('FIND SPARRING!',["class" => "btn btn-lg btn-block btn-primary"]) !!}
        </div>

    </form>

@endsection