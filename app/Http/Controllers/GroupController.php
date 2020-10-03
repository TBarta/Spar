<?php

namespace App\Http\Controllers;
use App\Photo;
use App\GroupArticles;
use App\UserHasGroup;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Group;
use Illuminate\Http\Request;
use App\Post;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index',"show");
        $this->middleware("checkifjoined")->only("join");
        $this->middleware("admin")->only("destroy");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::latest()->paginate(5);
        $view = view("groups.index");
        $view->groups = $groups;
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $view = view("groups.create");
        return $view;


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //STORE FUNCTION
    public function store(Request $request)
    {
        $user = User::where('id', '=', Auth::id())->first();
        
        $this->validate($request, [
            "name" => "required",
            "description" => "required",
        ]);
        
        $group = Group::create([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "nr_of_members" => 1,
            "private" => $request->input("type") == "private" ? 1 : 0,
        ]);

        $groupa = Group::find($group->id);
        
        
        UserHasGroup::create([
            'user_id' => $user->id,
            'group_id' => $groupa->id,
            "is_group_admin" => 1,
            "joined" => 1,
        ]);


        return redirect("/groups/".$group->id)->with("success", "Group Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */


     // SHOW FUNCTION
    public function show(Group $group)
    {
        // CREATING VIEW
        $view = view("groups.show");
        

        //DECLARING VARIABLES

        $articles = GroupArticles::where("group_id", "=", $group->id)->orderBy("id", "desc")->get();

        $posts = Post::where("group_id",$group->id)->orderBy("id", "desc")->get();

        $groupa = Group::find($group->id);
        $photos = Photo::where("group_id",$groupa->id)->latest()->get();

        $auth_user = Auth::id();

        $logged_user = UserHasGroup::where("group_id", "=", $groupa->id)->where("user_id","=", Auth::id())->first();

        $pending_logged_user = UserHasGroup::where("group_id","=", $groupa->id)->where("wanna_join", "=",1)->where("user_id","=", Auth::id())->first();

        $joined = UserHasGroup::where("group_id","=",$groupa->id)->where("joined","=", 1)->get();

        $pendings = UserHasGroup::where("group_id","=", $groupa->id)->where("wanna_join","=",1)->get();

        $joined_logged_user = UserHasGroup::where("group_id","=",$groupa->id)->where("joined","=", 1)->where("user_id", "=", Auth::id())->first();
        // FOREACHES

        //HANDLING USERS WHO SENT JOIN REQUEST
        
        if(count($pendings))
        {
            foreach($pendings as $pending)
            {
                $pending_users = User::where("id","=",$pending->user_id)->get();
                $view->pending_users = $pending_users;
            }
        }
        else {
            $view->pending_users = null;
        }

        // JOINED USERS 
        if(count($joined))
        {
            $joined_users = [];
            foreach($joined as $joins)
                {
                    
                    $joined_users[] = User::where("id","=",$joins->user_id)->first();
                    
                }

                $view->joined_users = $joined_users;
        }
        

        $private = Group::where("id","=",$groupa->id)->where("private", "=",1)->first();

        

        $admin = UserHasGroup::where("user_id", "=", Auth::id())->where("group_id", "=", $groupa->id)->where("is_group_admin", "=", 1)->first();
        

        //PASSING VARIABLES TO THE VIEW
        $view->groupa = $groupa;
        $view->auth_user = $auth_user;
        $view->articles = $articles;
        $view->posts = $posts;

        if($joined_logged_user)
        {
            $view->joined_logged_user = $joined_logged_user;
        }
        else
        {
            $view->joined_logged_user = 0;
        }
        if($pending_logged_user)
        {
            $view->pending_user = $pending_logged_user;
        }
        else
        {
            $view->pending_user = 0;
        }

       if($admin)
       {
           $view->admin = $admin;
       }
       else
       {
            $view->admin = 0;
       }
        
       if($photos)
       {
           $view->photos = $photos;
       }
       else
       {
           $view->photos = 0;
       }


        if($logged_user)
        {
        $view->joined = 1;
        }
        else
        {
        $view->joined = 0;
        }

        if($private)
        {
            $view->private = 1;
        }
        else
        {
            $view->private = 0;
        }


        return $view;
    }
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */

     // EDIT FUNCTION
    public function edit(Group $group)

    {
        $groupa = Group::FindOrFail($group->id);

        if(\Gate::denies('group_admin', $group)){
            return redirect("/groups/{$group->id}");
        }
        $view = view("groups.edit");
        $view->groupa = $groupa;
        return $view;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */

     // UPDATE FUNCTUON
    public function update(Request $request,Group $group)
    {
        $this->validate($request, [
            "name" => "required",
            "description" => "required",
        ]);
        $groupa = Group::FindOrFail($group->id);
        $groupa->update([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
        ]);

        return redirect("/groups/{$groupa->id}")->with("success", "Changes have been saved");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $groupa = Group::find($group->id);
        $groupa->delete();


        return redirect("/groups")->with("success", "Group Deleted");
    }
    public function join(Group $group)
    {   
        $user = User::where('id', '=', Auth::id())->first();
        $groupa = Group::find($group->id);

        $groupa->update([
            "nr_of_members" => $groupa->nr_of_members + 1,
        ]);

        UserHasGroup::create([
            'user_id' => $user->id,
            'group_id' => $groupa->id,
            "is_group_admin" => 0,
            "joined" => 1,
        ]);

        return redirect("/groups/{$group->id}")->with("success", "Group joined");
    }
    // LEAVE FUNCTION
    public function leave(Group $group)
    {   
        $user = UserHasGroup::where("group_id", "=", $group->id)->where('user_id', '=', Auth::id())->first();
        $groupa = Group::find($group->id);

        $groupa->update([
            "nr_of_members" => $groupa->nr_of_members - 1,
        ]);

        $user->delete();

        return redirect("/groups/{$group->id}")->with("success", "You left ".$groupa->name);
    }
}
