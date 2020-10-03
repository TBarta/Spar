<?php

namespace App\Http\Controllers;
use App\Photo;
use App\Group;
use App\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($group)
    {

        $view = view("groups.photos.index");
        $groupa = Group::find($group);
        $photos = Photo::where("group_id",$groupa->id)->latest()->get();
        if($photos)
        {
            $view->photos = $photos;
        }
        else
        {
            $view->photos = 0;
        }

        $view->groupa = $groupa;

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($group)
    {
        $view = view("groups.photos.create");
        $view->group_id = $group;
        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $group)
    {
        $this->validate($request, [

            "photo" => "image|max:1999",
            "description" => "required"

        ]);

            if($request->hasFile("photo")) 
            {

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
                    $original_path = $photo->storeAs("public/photos/groups/group".$request->input("group_id"), $filenameToStore);
                //     $resize_path = $photo->storeAs("public/photos/group".$request->input("group_id")."/dashboard", $filenameToStore);

                //     //resize for the dashboard
                //     $public_resized = storage_path("app/public/photos/group".$request->input("group_id")."/dashboard/". $filenameToStore);
                //     $img = Image::make($public_resized)->resize(100,100);
                //     $img->save($public_resized);
                }

        // Create photo in DB
            

        $photo = Photo::create([
            "group_id" => $request->input("group_id"),
            "user_id" => Auth::id(),
            "description" => $request->input("description"),
            "photo" => $filenameToStore,
        ]);
        Post::create([
            "photo_id" => $photo->id,
            "group_id" => $request->input("group_id"),
        ]);

        return redirect(action("GroupController@show", ["id" => $request->input("group_id")]))->with("success", "Photo Uploaded");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($group, $id)
    {
        $photo = Photo::find($id);
        $groupa = Group::find($group);
        $view = view("groups.photos.show");
        $view->photo = $photo;
        $view->groupa = $groupa;
        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($group, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$group, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group, $id)
    {
        $photo = Photo::find($id);
        $post = Post::where("photo_id",$id)->first();
        if(Storage::delete("public/photos/groups/group".$photo->group_id."/".$photo->photo))
        {
            $photo->delete();
            $post->delete();

            return redirect(action("GroupController@show", $photo->group_id))->with("success", "Picture deleted!");
        }
    }
}
