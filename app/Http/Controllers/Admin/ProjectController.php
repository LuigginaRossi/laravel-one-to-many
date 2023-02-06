<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects= Project::All();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
         $data= $request->validated();

         if(key_exists('cover_img', $data)){
            $path= Storage::put('projects', $data['cover_img']);
         }

         $project= Project::create([
             ...$data,
             "user_id" =>Auth::id(),
             "cover_img"=>$path ?? "DefaultImage",
         ]);

        // $data= $request->all();
        // $project= Project::create($data);

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project= Project::findOrFail($id);
        
        if (!$project) {
            abort(404, "Not found the project!");
        }

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project= Project::findOrFail($id);
        if (!$project) {
            abort(404, "Not found the project!");
        }
        return view('admin.projects.edit', compact('project'));
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
        $project= Project::findOrFail($id);
        $data= $request->all(); //validazione

        if(key_exists('cover_img', $data)){
            $path= Storage::put('projects', $data['cover_img']);

            Storage::delete($project->cover_img);
        }

        $project->update($data);

        return redirect()->route('admin.projects.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrfail($id);
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
