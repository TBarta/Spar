{!!Form::open(["action" => ["PhotosController@destroy", $photo->group_id , $photo->id], "method" => "POST" ])!!}
@method("delete")
{{Form::submit("Delete Photo", ["class" => "btn btn-lg btn-danger"])}}
{{Form::close()}}