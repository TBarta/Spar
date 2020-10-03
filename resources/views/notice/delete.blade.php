{!!Form::open(["action" => ["NoticeController@destroy", "notice" => $notice->id], "method" => "POST", "class" => "float-left", "onsubmit" => 'return confirm("Are you sure you want to delete your notice ?")'])!!}
@method("delete")
    {{ Form::submit("Delete", ["class" => "btn btn-danger"])}}
{!!Form::close()!!}