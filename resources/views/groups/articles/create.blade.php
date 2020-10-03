{!!Form::open(["action" => ["GroupArticlesController@store", "group" => $groupa->id], "method" => "POST"])!!}
{{ csrf_field() }}

{!!Form::textarea("text" ,null, ['class' => 'form-control',"rows" => 3, "placeholder" => "Let the group know..."])!!}

{!!Form::submit("Post!" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}