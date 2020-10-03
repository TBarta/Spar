<?php

namespace App\Http\Controllers;
use App\Friendlist;
use App\Tag;
use App\UserHasTag;
use App\UserHasGroup;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Message;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth_id = Auth::id();
        $new_messages = count(Message::where("recipient_id",$auth_id)->where("read", 0)->get());
        $accepted = Friendlist::where("user_id", $auth_id)->where("friend_id", $id)->where("accepted",1)->first();
        $requested = Friendlist::where("user_id",$auth_id)->where("friend_id",$id)->where("requested",1)->first();
        $requesters = Friendlist::where("friend_id",$auth_id)->where("requested",1)->get();
        $adders = [];
        if($requesters)
        {
        foreach($requesters as $requester)
        {
            $adders[] = User::where("id", $requester->user_id)->first();
        }
        }
        


        $joined_groups = UserHasGroup::where("user_id", Auth::id())->where("joined",1)->get();

        $groups = [];

        foreach($joined_groups as $group)
        {
            $groups[] = Group::where("id", $group->group_id)->first();
        }
 

        if($id==Auth::id() || $id == 0) {
            $user = User::where('id', '=', Auth::id())->first();
            return view('user.dashboard', ['user' => $user, "groups" => $groups, "requesters" => $adders, "new_messages" => $new_messages]);
        }
        $user = User::where('id', '=', $id)->first();
        return view('user.show', ['user' => $user, "requested" => $requested, "accepted" => $accepted]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id == Auth::id() || $id == 0) {
            $user = User::where('id', '=', Auth::id())->first();
            $tags = Tag::all();
            return view('user.edit', ['user' => $user, 'tags' => $tags]);
        }

        return 'You do not have permission to view this page.';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            "photo" => "image|max:1999",
        ]);
        
        // PHOTO UPLOADING
        if($request->hasFile("photo")) 
        {
                // deleting old pic
                $old_pic = $user->photo;
                Storage::delete("public/photos/users/user".$id."/profilepics/".$old_pic);


                    //getting the photo 

                $photo = $request->file("photo");

                    //get filename with the extension
                $filenameWithExt = $photo->getClientOriginalName();
                    // get just the filename
                
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    //get extentsion
                $extension = $photo->getClientOriginalExtension();

                    // create new filename
                $filenameToStore = $filename. "_" .time().".".$extension;
                
                //upload image
                $original_path = $photo->storeAs("public/photos/users/user".$id."/profilepics", $filenameToStore);
        }
        else
        {
            $filenameToStore = $user->photo;
        }


        $user->update([
            'name' => $request->input('name'),
            'email' => Auth::user()->email,
            'password' => Auth::user()->password,
            'about' => $request->input('about'),
            'image' => $request->input('image'),
            'address' => $request->input('address'),
            "photo" => $filenameToStore,
            'phone' => $request->input('phone'),
        ]);

        UserHasTag::where('user_id', '=', $id)->delete();

        foreach($request->tag as $tag){
            UserHasTag::insert([
                'user_id' => $id,
                'tag_id' => $tag
            ]);
        }


        session()->flash('success_message', 'Success!');

        return redirect()->action("UserController@show", ["id" => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile_pic($id)
    {
    $user = User::find($id);
    $view = view("user.profilepic");
    $view->user = $user;
    return $view;
    }
}
