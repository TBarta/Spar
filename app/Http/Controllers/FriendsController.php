<?php

namespace App\Http\Controllers;
use Auth;
use App\Friendlist;
use App\User;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function __contstruct() 
    {
        $this->middleware("auth");
    }
    public function addfriend($id)
    {
        $auth_id = Auth::id();
        $friend = User::find($id);

        Friendlist::create([
            "user_id" => $auth_id,
            "friend_id" => $friend->id,
            "requested" => 1,
        ]);
        Friendlist::create([
            "user_id" => $friend->id,
            "friend_id" => $auth_id,
        ]);
        return redirect()->back();
    }
    public function accept($id)
    {
        $auth_id = Auth::id();
        $requester = User::find($id);
        $friendlist = Friendlist::where("friend_id", $auth_id)->where("requested", 1)->where("user_id", $requester->id)->first();
        $friendlist2 = Friendlist::where("friend_id", $requester->id)->where("user_id", $auth_id)->first();
        $friendlist->update([
            "requested" => 0,
            "accepted" =>1,
        ]);
        $friendlist2->update([
            "accepted" => 1,
        ]);
        return redirect(action("UserController@show", ["id" => $auth_id]))->with("success", $requester->name." is your new buddy!");
    }
    public function deny($id)
    {
        $auth_id = Auth::id();
        $requester = User::find($id);
        $friendlist = Friendlist::where("friend_id", $auth_id)->where("requested", 1)->where("user_id", $requester->id)->first();
        $friendlist->delete();
        $friendlist2 = Friendlist::where("friend_id", $requester->id)->where("user_id", $auth_id)->first();
        $friendlist2->delete();
        return redirect(action("UserController@show", ["id" => $auth_id]))->with("success", "You denied the request");
    }
    public function cancel($id)
    {
        $auth_id = Auth::id();
        $requested = User::find($id);
        $friendlist = Friendlist::where("friend_id", $requested->id)->where("requested", 1)->where("user_id", $auth_id)->first();
        $friendlist2 = Friendlist::where("friend_id", $auth_id)->where("user_id", $requested->id)->first();
        $friendlist->delete();
        $friendlist2->delete();
        return redirect(action("UserController@show", ["id" => $requested->id]));
    }
    public function delete($id)
    {
        $auth_id = Auth::id();
        $friend = User::find($id);
        $friendlist = Friendlist::where("friend_id", $auth_id)->where("user_id", $friend->id)->first();
        $friendlist2 = Friendlist::where("friend_id", $friend->id)->where("user_id", $auth_id)->first();
        $friendlist->delete();
        $friendlist2->delete();
        return redirect(action("UserController@show", ["id" => $friend->id]))->with("success", $friend->name." is not your buddy anymore :(");
    }
}
