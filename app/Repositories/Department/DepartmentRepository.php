<?php
 namespace App\Repositories\Department;
 use App\Models\Department;
 use Auth;

 class DepartmentRepository implements DepartmentInterface
 {
 	public function fetch($request)
 	{
 		try
 		{
 			$query = Department::query();

 			if($request->has('search') && !empty($request->search))
 			{
 				$search = $request->search;

 				$query->where('departments.department_name', 'LIKE', "%$search%");

 			}

 			$departments = $query->select('*');

 			return $departments;
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function store($request)
 	{
 		try
 		{
 			Department::create([
 				'user_id' => Auth::user()->id,
 				'department_name' => $request->department_name,
 				'status' => $request->status,
 			]);

 			return response(['success'=>true, 'message'=>'Successfully a department has been added']);

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function update($request,$department)
 	{
 		try
 		{
 			$department->update($request->validated());
 			return response(['success'=>true, 'message'=>'Successfully the department has been updated']);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function delete($department)
 	{
 		try
 		{
 			$department->delete();
 			return response(['success'=>true, 'message'=>'Successfully the department has been deleted']);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function statusUpdate($request)
 	{
 		try
 		{
 			$department = Department::findorfail($request->department_id);
 			$department->status = $request->status;
 			$department->update();

 			return response()->json(['success'=>true, 'message'=>"Successfully the department's status has been updated"]);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}
 }