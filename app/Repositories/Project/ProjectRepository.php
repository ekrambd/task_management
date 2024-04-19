<?php
 namespace App\Repositories\Project;
 use App\Models\Project;
 use Auth;

 class ProjectRepository implements ProjectInterface
 {
 	public function fetch($request)
 	{
 		try
 		{
 			$query = Project::query();

 			if($request->has('search') && !empty($request->search))
 			{
 				$search = $request->search;

 				$query->where('projects.project_name', 'LIKE', "%$search%");

 			}

 			if($request->has('department_id'))
 			{
 				$query->where('projects.department_id',$request->department_id);
 			}

 			if($request->has('category_id'))
 			{
 				$query->where('projects.category_id',$request->category_id);
 			}

 			if($request->has('client_id'))
 			{
 				$query->where('projects.client_id',$request->client_id);
 			}

 			$projects = $query->select('*');

 			return $projects;

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function store($request)
 	{
 		try
 		{
 			Project::create([
 				'user_id' => Auth::user()->id,
 				'category_id' => $request->category_id,
 				'client_id' => $request->client_id,
 				'project_name' => $request->project_name,
 				'project_priority' => $request->project_priority,
 				'start_date' => $request->start_date,
 				'duration' => $request->duration,
 				'duration_unit' => $request->duration_unit,
 				'end_date' => $request->end_date,
 				'project_cost' => $request->project_cost,
 				'status' => $request->status,
 				'description' => $request->description,
 			]);

 			return response(['success'=>true, 'message'=>'Successfully a project has been added']);

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function update($request,$project)
 	{
 		try
 		{
 			$project->update($request->validated());
 			return response()->json(['success'=>true, 'message'=>'Successfully the project has been updated']);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function delete($project)
 	{
 		try
 		{
 			$project->delete();
 			return response()->json(['success'=>true, 'message'=>'Successfully the project has been deleted']);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}
 } 