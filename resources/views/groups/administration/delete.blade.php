{!!Form::open(["action" => ["GroupController@destroy", $groupa->id], "method" => "POST", "class" => "float-right", "onsubmit" => 'return confirm("Are you sure you want to delete ' . $groupa->name . ' ?")'])!!}
@method("delete")
    {{ Form::submit("Delete Group", ["class" => "btn btn-danger"])}}
{!!Form::close()!!}