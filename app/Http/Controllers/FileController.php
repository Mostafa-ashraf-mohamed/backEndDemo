<?php

namespace App\Http\Controllers;

use App\File;
use App\ShareTo;
use App\User;
use App\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class FileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = auth()->user()->id;
        $file = File::where("userid","=","$userid")->get();
        return view('files.index')->with('indexFiles' , $file );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required",
            "fileInput"=>"required"
        ]);

        $file = new File();
        $file->title = $request->title;
        $file->des = $request->des;
        $file->userid=$request->userid;
        $file->	shareStatus="unshare";

        $file_data=$request->file('fileInput');
        $file_name = time() . $file_data->getClientOriginalName() . "." . $file_data->getClientOriginalExtension();
        $file_data->move('uploded',$file_name);
        $file->	fileExt=$file_data->getClientOriginalExtension();
        $file->	file = $file_name;
        $file->save();

        return view('files.create')->with('done' , 'file added' );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::find($id);
        return view('files.view')->with('data' , $file );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = File::find($id);
        return view('files.edit')->with('data' , $file );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title"=>"required",
        ]);

        $file =  File::find($id);
        $file->title = $request->title;
        $file->des = $request->des;
        $file->save();

        $userid = auth()->user()->id;
        $file = File::where("userid","=","$userid")->get();
        return view('files.index')->with('indexFiles' , $file );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $file = File::find($id);
        unlink(public_path('uploded/'.$file->file));
        $file->delete();
        $userid = auth()->user()->id;
        $file = File::where("userid","=","$userid")->get();
        return view('files.index')->with('indexFiles' , $file );
    }
    public function download($id){
        $file = File::where("id","=",$id)->firstOrFail();
        $filePath=public_path('uploded/'.$file->file);
        return response()->download($filePath);
    }
    public function public(){
        $file = File::where("shareStatus","share")->get();
        return view('publicFiles.index')->with('indexFiles' , $file );
    }
    public function share($id){
        $file = File::find($id);
        $ShareTo = ShareTo::where('fileid', '=', "$id")->get();
        return view('publicFiles.share',compact(['file', 'ShareTo']));
    }
    public function shareTo(Request $request)
    {
        $request->validate([
            "email"=>"required",
            "fileid"=>"required"
        ]);

        $user = User::where('email', '=', "$request->email")->exists();
        $file =  File::find($request->fileid);
        if ($user) {
            $ShareTo = new ShareTo();
            $ShareTo->fileid  = $request->fileid;
            $ShareTo->email  = $request->email;
            $ShareTo->save();
         }
         return redirect()->back()->with("data" , $file );
    }
    public function toMeShow()
    {
        $email = auth()->user()->email;
        $indexFiles = FacadesDB::table('files')
        ->select('files.id','files.title','files.fileExt','files.userid','files.des','files.file','files.shareStatus','files.created_at','files.updated_at')
        ->join('fileshareto','files.id','=','fileshareto.fileid')
        ->where("fileshareto.email","=","$email")
        ->get();
        return view('publicFiles.toMe')->with("indexFiles",$indexFiles);
    }
    public function shareToAll($id){
        $file = File::find($id);
        $file->shareStatus = "share";
        $file->save();
        return view('home');
    }
    public function makePrivate($id){
        $file = File::find($id);
        $file->shareStatus = "unshare";
        $file->save();
        return view('home');
    }
    public function publicdestroy($id){
        $ShareTo = ShareTo::find($id);
        $ShareTo->delete();
        return redirect()->back()->with('done' , 'file delete' );
    }
}
