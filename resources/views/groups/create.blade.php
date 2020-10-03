@extends("layouts/app")
@section("content")
<h1>Create Group</h1>
{!!Form::open(["action" => "GroupController@store", "method" => "POST"])!!}
{{ csrf_field() }}
{{ Form::label("Name", "Give your group a name", ['class' => 'control-label']) }}
{!!Form::text("name" ,null, ['class' => 'form-control', "placeholder" => "Name of your Group"])!!}
{{ Form::label("Body", "Group's Description ", ['class' => 'control-label']) }}
{!!Form::textarea("description" ,null, ['class' => 'form-control', "placeholder" => "A brief info about the group..."])!!}

<div class="form-group">
        Public {!! Form::radio("type", "public", "checked") !!}<br>
        Private {!! Form::radio("type", "private") !!}
    </div>
{!!Form::submit("Create group!" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}

<a href="{{action("GroupController@index")}}">BACK TO LIST OF GROUPS</a>
@endsection
