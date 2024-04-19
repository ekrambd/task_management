<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Project\ProjectInterface;
class ExtraController extends Controller
{   

	protected $project;

	public function __construct(ProjectInterface $project)
	{
		$this->project = $project;
	}

    public function departmentProjects(Request $request,$id)
    {   
        $projects = $this->project->fetch($request)->where('department_id',$id)->latest()->paginate(10);

        return response()->json([
            'success' => $projects->total() > 0,
            'message' => $projects->total() > 0 ? 'Data found' : 'No data found',
            'total' => $projects->total(),
            'data' => $projects
        ]);
    }
}
