
            {!!Form::open(["action" => ["GroupAdministrationController@kick","user" => $user->id, "group" => $groupa->id], "method" => "POST" , "onsubmit" => 'return confirm("Are you sure you want to kick ' . $user->name . ' ?")'])!!}
            {{ Form::submit("Kick", ["class" => "btn btn-danger btn-sm"])}}
            {!!Form::close()!!}