@extends("layouts/app")
@section("content")
<h1>{{$groupa->name}}</h1>

{!!Form::open(["action" => ["GroupController@update", "id" => $groupa->id], "method" => "POST", "enctype" => "multipart/form-data"])!!}

@method('put')

{{ csrf_field() }}

{{ Form::label("Name", "Give your group a name", ['class' => 'control-label']) }}
{!!Form::text("name", $groupa->name, ['class' => 'form-control'])!!}

{{ Form::label("Body", "Group's Description ", ['class' => 'control-label']) }}
{!!Form::textarea("description" ,$groupa->description, ['class' => 'form-control', "placeholder" => "A brief info about the group..."])!!}

{{ Form::label("cover_photo", "Upload a cover picture", ['class' => 'control-label']) }}
{!! Form::file('cover_photo', ['class' => 'form-control']) !!}
{!!Form::submit("Save changes" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}

<a href="{{action("GroupController@show", ["id" => $groupa->id])}}"
        class="btn btn-light btn-outline-secondary">GO BACK</a>
@endsection
