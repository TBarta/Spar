<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trainer;
use Auth;

class TrainerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except("index");
        $this->middleware("checkiftrainer")->only("dashboard");
        $this->middleware("istrainer")->only("create");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainers = Trainer::where("registered", 1)->latest()->get();
        $view = view("trainer.index");
        $view->trainers = $trainers;
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainer = Trainer::where("user_id", Auth::id())->first();
        if(!$trainer)
        {
        $view = view("trainer.create.step1");
        return $view;
        }
        elseif(!$trainer->experience)
        {
            $view = view("trainer.create.step2");
            $view->trainer = $trainer;
            return $view;
        }
        elseif(!$trainer->program)
        {
            $view = view("trainer.create.step3");
            $view->trainer = $trainer;
            return $view;
        }
        elseif(!$trainer->contact)
        {
            $view = view("trainer.create.step4");
            $view->trainer = $trainer;
            return $view;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trainer = Trainer::where("user_id", Auth::id())->first();

        if(!$trainer)
        {
        $this->validate($request,[
            "field" => "required",
        ]);
        Trainer::create([
            "field" => $request->input("field"),
            "user_id" => Auth::id(),
        ]);
        }
        elseif(!$trainer->experience)
        {
            $this->validate($request,[
                "experience" => "required",
            ]);
            $trainer->update([
                "experience" => $request->input("experience"),
                "qualification" => $request->input("qualification"),
            ]);
        }
        elseif(!$trainer->program)
        {
            $this->validate($request,[
                "program" => "required",
                "price" => "required",
            ]);
            $trainer->update([
                "program" => $request->input("program"),
                "price" => $request->input("price"),
            ]);
        }
        elseif(!$trainer->contact)
        {
            $this->validate($request,[
                "contact" => "required",
            ]);

             // PHOTO UPLOADING
        if($request->hasFile("photo")) 
        {
            $this->validate($request,[
                "photo" => "image|max:1999",
            ]);

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
                $original_path = $photo->storeAs("public/photos/trainers/trainer".$trainer->id."/profilepics", $filenameToStore);
        }
        else
        {
            $filenameToStore = "trainer.png";
        }

            $trainer->update([
                "contact" => $request->input("contact"),
                "photo" => $filenameToStore,
                "registered" => 1,
                "trainer_name" => $trainer->user->name,
            ]);

            return redirect(action("TrainerController@dashboard"));
        }
        return redirect(action("TrainerController@create"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view = view("trainer.show");
        $trainer = Trainer::find($id);
        $view->trainer = $trainer;

        return $view;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainer = Trainer::find($id);
        $view = view("trainer.edit");
        $view->trainer = $trainer;
        return $view;
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
        
        $trainer = Trainer::find($id);

     
        $this->validate($request,[
            "field" => "required",
            "program" => "required",
            "price" => "required",
            "experience" => "required",
            "contact" => "required",
        ]);


        

             // PHOTO UPLOADING
        if($request->hasFile("photo")) 
        {
            $this->validate($request,[
                "photo" => "image|max:1999",
            ]);

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
                $original_path = $photo->storeAs("public/photos/trainers/trainer".$trainer->id."/profilepics", $filenameToStore);
        

        }
        else
        {
            $filenameToStore = $trainer->photo;
        }


        $trainer->update([
            "field" => $request->input("field"),
            "experience" => $request->input("experience"),
            "qualification" => $request->input("qualification"),
            "program" => $request->input("program"),
            "price" => $request->input("price"),
            "photo" => $filenameToStore,
        ]);



        return redirect(action("TrainerController@dashboard"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainer = Trainer::find($id);

        $trainer->delete();

        return redirect("/")->with("success", "Your Trainer profile has been deleted");
        
    }

    public function goback($id)
    {
        $trainer = Trainer::find($id);
        
        if(!$trainer->experience)
        {
            $trainer->delete();
        }
        elseif(!$trainer->program)
        {
            $trainer->experience = null;
            $trainer->qualification = null;
            $trainer->save();
        }
        elseif(!$trainer->contact)
        {
            $trainer->program = null;
            $trainer->price = null;
            $trainer->save();
        }
        return redirect(action("TrainerController@create"));
    }
    public function dashboard()
    {
        $auth = Auth::id();
        $trainer = Trainer::where("user_id", $auth)->first();
        $view = view("trainer.dashboard");
        $view->trainer = $trainer;
        return $view;
    }
}
