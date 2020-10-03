@extends("layouts.app")
@section("content")
{!!Form::open(["action" => ["GroupArticlesController@update", "id" => $article->id, "group" => $group->id], "method" => "POST"])!!}

{{ csrf_field() }}

{!!Form::textarea("text" ,$article->article, ['class' => 'form-control',"rows" => 3])!!}

{!!Form::submit("Update" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}

<a href="{{action("GroupController@show", ["id" => $group->id])}}"
        class="btn btn-light btn-outline-secondary">GO BACK</a>
@endsection


