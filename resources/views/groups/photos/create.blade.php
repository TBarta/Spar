@extends("layouts.app")
@section("content")
<br>
<a href="{{action("GroupController@show", ["id" => $group_id])}}"
        class="btn btn-secondary">GO BACK</a>
        <br><br>
{!!Form::open(["action" => ["PhotosController@store", "id" => $group_id], "method" => "POST", "enctype" => "multipart/form-data"])!!}
{{ csrf_field() }}


{!!Form::textArea("description", null, ['class' => 'form-control',"rows" => 2,"placeholder" => "Describe this picture"])!!}

{{Form::hidden("group_id", $group_id)}}
<br>
{!!Form::file("photo" , ['class' => 'form-control-file'])!!}
<br>
{!!Form::submit("Add picture" ,["class" => "btn btn-lg btn-primary form-control"])!!}
{!!Form::close() !!}

@endsection