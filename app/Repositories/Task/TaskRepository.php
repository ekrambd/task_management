<?php
namespace App\Repositories\Task;
use App\Models\Task;
use DB;
use Auth;

class TaskRepository implements TaskInterface
{
	public function fetch($request)
	{
		try
		{
			$tasks = Task::query();

			$query = Category::query();

 			if($request->has('search') && !empty($request->search))
 			{
 				$search = $request->search;

 				$query->where('tasks.task_title', 'LIKE', "%$search%");

 			}

 			if($request->has('project_id'))
 			{
 				$query->where('tasks.project_id',$request->project_id);
 			}

 			$tasks = $query->select('*');

 			return $tasks;

		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
	}

	public function store($request)
	{   

		DB::beginTransaction();
		try
		{
			$task = Task::create([
				'user_id' => Auth::user()->id,
				'category_id' => $request->category_id,
				'department_id' => $request->department_id,
				'project_id' => $request->project_id,
				'task_title' => $request->task_title,
				'project_priority' => $request->project_priority,
				'start_date' => $request->start_date,
				'duration' => $request->duration,
				'end_date' => $request->end_date,
				'status' => $request->status,
				'description' => $request->description
			]);

			$user_ids = json_decode($request->user_ids,true);

			$task->users()->attach($user_ids);

			DB::commit();

			return response()->json(['success'=>true, 'message'=>'Successfully a task has been added']);
		}catch(Exception $e){

            $code = $e->getCode();   
            DB::rollback();        
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
	}

	public function update($request,$task)
	{
		try
		{
			$task->update($request->validated());

			$user_ids = json_decode($request->user_ids, true);

			$task->users()->detach($user_ids);

            DB::commit();

            return response()->json(['success'=>true, 'message'=>'Successfully the task has been updated']);

		}catch(Exception $e){

            $code = $e->getCode();  
            DB::rollback();         
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
	}

	public function delete($task)
	{
		try
		{
			$task->delete();
			return response()->json(['success'=>true, 'message'=>'Successfully the task has been deleted']);
		}catch(Exception $e){

            $code = $e->getCode();  
            DB::rollback();         
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
	}

	public function statusUpdate($request)
	{
		try
		{
			$task = Task::findorfail($request->task_id);
			$task->status = $request->status;
			$task->update();

			return response()->json(['success'=>true, 'message'=>"Successfully the task's status has been updated"]);
		}catch(Exception $e){

            $code = $e->getCode();  
            DB::rollback();         
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
	}
}