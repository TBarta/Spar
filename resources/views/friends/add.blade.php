{!!Form::open(["action" => ["FriendsController@addfriend", "id" => $user->id], "method" => "POST"])!!}
    {{ Form::submit("Add Buddy", ["class" => "btn btn-success"])}}
{!!Form::close()!!}