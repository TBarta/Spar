{!!Form::open(["action" => ["GroupArticlesController@destroy", "group" => $groupa->id, "id" =>  $post->article->id], "method" => "POST", "class" => "float-right", "onsubmit" => 'return confirm("Are you sure you want to delete this article ?")'])!!}
    {{ Form::submit("Delete", ["class" => "btn btn-sm btn-danger"])}}
{!!Form::close()!!}