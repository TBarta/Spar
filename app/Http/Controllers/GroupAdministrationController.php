<?php

namespace App\Http\Controllers;

use App\GroupArticles;
use App\UserHasGroup;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class GroupAdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("admin")->except("joinrequest", "cancelrequest","createpicture","storepicture");
        $this->middleware("checkifjoined")->only("joinrequest");
        $this->middleware("uploadadmin")->only("createpicture");
    }


    //  KICK FUNCTION
    public function kick(Group $group, User $user)
    {   
        $admin = UserHasGroup::where("is_group_admin", "=", 1)->first();
        
            $groupa = Group::find($group->id);


            $user = UserHasGroup::where('user_id', '=', $user->id)->where("group_id", "=", $group->id)->first();

            
            
            
            $groupa->update([
                "nr_of_members" => $groupa->nr_of_members - 1,
            ]);
   
            $user->delete();

            return redirect()->back();
    
    }

    // SEND JOIN REQUEST (ONLY FOR PRIVATE GROUPS)
    public function joinrequest(Group $group)
    {
    $user = User::where('id', '=', Auth::id())->first();
    $groupa = Group::find($group->id);


    UserHasGroup::create([
        'user_id' => $user->id,
        'group_id' => $groupa->id,
        "is_group_admin" => 0,
        "joined" => 0,
        "wanna_join" => 1,
    ]);

    return redirect("/groups/{$group->id}")->with("success", "Request sent");
    }
    // CANCEL JOIN REQUEST (ONLY FOR PRIVATE GROUPS)

    public function cancelrequest(Group $group)
    {   
        $user = UserHasGroup::where("group_id", "=", $group->id)->where('user_id', '=', Auth::id())->first();

        $user->delete();

        return redirect("/groups/{$group->id}")->with("success", "Request cancelled");
    }
    public function acceptrequest(Group $group, User $user)
    {
        $username = User::where("id", $user->id)->first();
        $groupa = Group::find($group->id);
        $user = UserHasGroup::where("group_id","=",$group->id)->where("user_id","=",$user->id)->first();
       

        $groupa->update([
            "nr_of_members" => $groupa->nr_of_members + 1,
        ]);

        $user->update([
            "joined" => 1,
            "wanna_join" => 0,
        ]);

        return redirect()->back()->with("success", "You have accepted ".$username->name." to the group");
    }

    public function declinerequest(Group $group, User $user)
    {   
        $user = UserHasGroup::where("group_id", "=", $group->id)->where('user_id', '=', $user->id)->first();

        $user->delete();

        return redirect("/groups/{$group->id}")->with("success", "Request declined");
    }
    public function createpicture($id)
    {
        $group = Group::find($id);
        $view = view("groups.administration.upload");
        $view->group = $group;
        return $view;
    }
    public function storepicture(Request $request, $id)
    {
        $this->validate($request, [

            "cover_photo" => "required|image|max:1999",

        ]);

        $group = Group::find($id);

            if($request->hasFile("cover_photo")) 
            {

                $old_pic = $group->cover_photo;
                Storage::delete("public/photos/groups/group".$id."/coverphotos/".$old_pic);

                        //getting the photo 

                    $photo = $request->file("cover_photo");

                        //get filename with the extension
                    $filenameWithExt = $photo->getClientOriginalName();
                        // get just the filename

                    
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    

                        //get extentsion
                    $extension = $photo->getClientOriginalExtension();

                        // create new filename
                    $filenameToStore = $filename. "_" .time().".".$extension;
                    
                    //upload image
                    $original_path = $photo->storeAs("public/photos/groups/group".$id."/coverphotos", $filenameToStore);
                //     $resize_path = $photo->storeAs("public/photos/group".$request->input("group_id")."/dashboard", $filenameToStore);

                //     //resize for the dashboard
                //     $public_resized = storage_path("app/public/photos/group".$request->input("group_id")."/dashboard/". $filenameToStore);
                //     $img = Image::make($public_resized)->resize(100,100);
                //     $img->save($public_resized);
                }
                else
                {
                    $filenameToStore = $group->cover_photo;
                }
        // upload photo to DB
            

            $group->update([
                "cover_photo" => $filenameToStore,
            ]);

        return redirect(action("GroupController@show", ["id" => $group->id]))->with("success", "Cover Photo Uploaded");
    }
}
