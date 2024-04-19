<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Repositories\Project\ProjectInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $project;

    public function __construct(ProjectInterface $project)
    {
        $this->project = $project;
    }

    public function index(Request $request)
    {
        $projects = $this->project->fetch($request)->latest()->paginate(10);

        return response()->json([
            'success' => $projects->total() > 0,
            'message' => $projects->total() > 0 ? 'Data found' : 'No data found',
            'total' => $projects->total(),
            'data' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $storeProject = $this->project->store($request);
        return $storeProject;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response()->json(['success'=>true, 'data'=>$project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $updateProject = $this->project->update($request,$project);
        return $updateProject;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $deleteProject = $this->project->delete($project);
        return $deleteProject;
    }
}
