<h2>Pending users:</h2>
<ul class="list-group">

    @foreach($pending_users as $pending_user)
    <li class="list-group-item">
        {{$pending_user->name}}
    {!!Form::open(["action" => ["GroupAdministrationController@acceptrequest",$groupa->id, $pending_user->id], "method" => "POST", "class" => "float-right"])!!}
        {{ Form::submit("Accept", ["class" => "btn btn-success float-center"])}}
    {!!Form::close()!!}
    {!!Form::open(["action" => ["GroupAdministrationController@declinerequest",$groupa->id, $pending_user->id], "method" => "POST", "class" => "float-right"])!!}
    {{ Form::submit("Decline", ["class" => "btn btn-danger float-right"])}}
{!!Form::close()!!}
    </li>
    @endforeach

</ul>