{!!Form::open(["action" => ["FriendsController@delete", "id" => $user->id], "method" => "POST"])!!}
    {{ Form::submit("Delete Buddy", ["class" => "btn btn-danger ml-2"])}}
{!!Form::close()!!}