{!!Form::open(["action" => ["FriendsController@cancel", "id" => $user->id], "method" => "POST"])!!}
    {{ Form::submit("Cancel Friend Request", ["class" => "btn btn-danger"])}}
{!!Form::close()!!}