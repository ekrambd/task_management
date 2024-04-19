<?php
 namespace App\Repositories\Designation;
 use App\Models\Designation;
 use Auth;

 class DesignationRepository implements DesignationInterface
 {
 	public function fetch($request)
 	{
 		try
 		{
 			$query = Designation::query();

 			if($request->has('search') && $request->search)
 			{
 				$search = $request->search;

 				$query->where('designations.designation_name', 'LIKE', "%$search%");
 			}

 			$designations = $query->select('*');
            
            return $designations;
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function store($request)
 	{
 		try
 		{
 			Designation::create([
 				'user_id' => Auth::user()->id,
 				'designation_name' => $request->designation_name,
 				'status' => $request->status,
 			]);

 			return response()->json(['success'=>true, 'message'=>'Successfully a designation has been added']);

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function update($request,$designation)
 	{
 		try
 		{
 			$designation->designation_name = $request->designation_name;
 			$designation->status = $request->status;
 			$designation->update();

 			return response()->json(['success'=>true, 'message'=>'Successfully the designation has been updated']);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function delete($designation)
 	{
 		try
 		{
 			$designation->delete();
 			return response()->json(['success'=>true, 'message'=>'Successfully the designation has been updated']);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function statusUpdate($request)
 	{
 		try
 		{
 			$designation = Designation::findorfail($request->designation_id);
 			$designation->status = $request->status;
 			$designation->update();

 			return response()->json(['success'=>true, 'message'=>"Successfully the designation's status updated"]);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}
 }