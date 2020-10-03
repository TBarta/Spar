{!!Form::open(["action" => ["FriendsController@accept", "id" => $requester->id], "method" => "POST"])!!}
    {{ Form::submit("Add Buddy", ["class" => "btn btn-sm btn-success"])}}
{!!Form::close()!!}