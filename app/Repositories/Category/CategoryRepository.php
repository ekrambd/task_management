<?php
 namespace App\Repositories\Category;
 use App\Models\Category;
 use Auth;

 class CategoryRepository implements CategoryInterface
 {
 	public function fetch($request)
 	{
 		try
 		{
 			$query = Category::query();

 			if($request->has('search') && !empty($request->search))
 			{
 				$search = $request->search;

 				$query->where('categories.category_name', 'LIKE', "%$search%");

 			}

 			$categories = $query->select('*');

 			return $categories;

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function store($request)
 	{
 		try
 		{
 			Category::create([
 				'user_id' => Auth::user()->id,
 				'category_name' => $request->category_name,
 				'status' => $request->status,
 			]);

 			return response(['success'=>true, 'message'=>'Successfully a category has been added']);

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function update($request,$category)
 	{
 		try
 		{
 			$category->update($request->validated());
 			return response()->json(['success'=>true, 'message'=>'Successfully the category has been updated']);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function delete($category)
 	{
 		try
 		{
 			$category->delete();
 			return response()->json(['success'=>true, 'message'=>'Successfully the category has been deleted']);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function statusUpdate($request)
 	{
 		try
 		{
 			$category = Category::findorfail($request->category_id);
 			$category->status = $request->status;
 			$category->update();

 			return response()->json(['success'=>true, 'message'=>"Successfully the category's status has been updated"]);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}
 }