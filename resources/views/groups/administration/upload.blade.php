@extends("layouts.app")
@section("content")
<br>
<a href="{{action("GroupController@show", ["id" => $group->id])}}"
        class="btn btn-secondary">GO BACK</a>
        <br><br>
{!!Form::open(["action" => ["GroupAdministrationController@storepicture", "id" => $group->id], "method" => "POST", "enctype" => "multipart/form-data"])!!}
{{ csrf_field() }}

<br>
{!!Form::file("cover_photo" , ['class' => 'form-control-file', "required"])!!}
<br>

{!!Form::submit("Upload cover picture" ,["class" => "btn btn-block btn-primary form-control"])!!}
{!!Form::close() !!}

@endsection