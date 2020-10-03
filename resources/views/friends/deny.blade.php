{!!Form::open(["action" => ["FriendsController@deny", "id" => $requester->id], "method" => "POST"])!!}
    {{ Form::submit("Deny request", ["class" => "btn btn-sm btn-danger ml-2"])}}
{!!Form::close()!!}