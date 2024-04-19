<?php
 namespace App\Repositories\User;
 use App\Models\User;
 use App\Models\Userinfo;
 use Auth;
 use DB;
 use Image;
 use Illuminate\Support\Facades\File;
 class UserRepository implements UserInterface
 {
 	public function fetch($request)
 	{
 		try
 		{
 			$query = User::query();

 			if($request->has('search') && !empty($request->search))
 			{
 				$query->where('users.name', 'LIKE', "%$search%")->orWhere('users.email',$request->email)->orWhere('users.phone',$request->phone);
 			}

 			if($request->has('role_id'))
 			{
 				$query->where('role_id',$request->role_id);
 			}


 			$users = $query->whereNot('id',auth()->user()->id)->select('*');

 			return $users; 

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
 			$user = User::create([

 				'name' => $request->name,
 				'role_id' => $request->role_id,
 				'added_by' => auth()->user()->id,
 				'email' => $request->email,
 				'phone' => $request->phone,
 				'image' => $this->addImage($request),
 				'password' => bcrypt('123456'),
 				'status' => $request->status,
 			]);

 			$userinfo = new Userinfo();
 			$userinfo->user_id = $user->id;
 			$userinfo->employee_id = $request->employee_id;
 			$userinfo->nid_passport = $request->nid_passport;
 			$userinfo->department_id = $request->department_id;
 			$userinfo->designation_id = $request->designation_id;
 			$userinfo->joining_date = $request->joining_date;
 			$userinfo->address = $request->address;
 			$userinfo->save();

 			DB::commit();

 			return response()->json(['success'=>true, 'message'=>"Successfully an employee has been added"]);

 		}catch(Exception $e){

            $code = $e->getCode(); 
            DB::rollback();          
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function addImage($request)
	{	  
		if($request->image)
		{
		   $position = strpos($request->image, ';');
           $sub=substr($request->image, 0 ,$position);
           $ext=explode('/', $sub)[1];
           $name=time().".".$ext;
           $img=Image::make($request->image);
           $upload_path='uploads/users/';
           $image_url=$upload_path.$name;
           $img->save($image_url); 
           $path = $image_url;
		}
		else
		{
			$path = "'defaults/profile.png";  
		}

		return $path;
	}

	public function update($request,$user)
	{
		DB::beginTransaction(); 
 		try
 		{ 			

 			$user->name = $request->name;
 			$user->email = $request->email;
 			$user->phone = $request->phone;
 			$user->image = $this->updateImage($request,$user);
 			$user->status = $request->status;
 			$user->update();

 			$userinfo = $user->userinfo;
 			$userinfo->nid_passport = $request->nid_passport;
 			$userinfo->department_id = $request->department_id;
 			$userinfo->designation_id = $request->designation_id;
 			$userinfo->joining_date = $request->joining_date;
 			$userinfo->address = $request->address;
 			$userinfo->update();

 			DB::commit();

 			return response()->json(['success'=>true, 'message'=>"Successfully the employee has been updated"]);

 		}catch(Exception $e){

            $code = $e->getCode(); 
            DB::rollback();          
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
	}

	public function updateImage($request,$user)
	{
 	    if($request->image && checkPathUser($request,$user))  
		{
		   $position = strpos($request->image, ';');
           $sub=substr($request->image, 0 ,$position);
           $ext=explode('/', $sub)[1];
           $name=time().".".$ext;
           $img=Image::make($request->image);
           if($user->image != NULL)
           {
           	   $this->imgPath($user);
           }
           
           $upload_path='uploads/users/';
           $image_url=$upload_path.$name;
           $img->save($image_url); 
           $path = $image_url;
		}
		else
		{
			$path = $user->image;  
		}

		return $path;
	}

	public function imgPath($user)
    {
    	$parsedUrl = parse_url($user->image);
		$imagePath = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';

		if ($imagePath && File::exists(public_path($imagePath))) {
		    File::delete(public_path($imagePath));
		} 
    }


    public function delete($user)
    {
    	try
    	{
    		if($user->image != NULL)
			{
				$this->imgPath($user);
			}

            $user->delete();

            return response(['success'=>true, 'message'=>'Successfully the user has been deleted']);

    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

    public function statusUpdate($request)
    {
    	try
    	{
    		$user = User::findorfail($request->user_id);
    		$user->status = $request->status;
    		$user->update();

    		return response()->json(['success'=>true, 'message'=>"Successfully the user's status has been updated"]);

    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

 }