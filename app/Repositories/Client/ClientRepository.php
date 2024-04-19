<?php
 namespace App\Repositories\Client;
 use App\Models\Client;
 use Auth;
 use Image;
 use Illuminate\Support\Facades\File;

 class ClientRepository implements ClientInterface
 {
 	public function fetch($request)
 	{
 		try
 		{
 			$query = Client::query();

 			if($request->has('search') && !empty($request->search))
 			{
 				$search = $request->search;

 				$query->where('clients.client_name', 'LIKE', "%$search%")->orWhere('clients.client_email',$search)->orWhere('clients.client_phone',$search);

 			}

 			$clients = $query->select('*');

 			return $clients;

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function store($request)
 	{
 		try
 		{
 			Client::create([
 				'user_id' => Auth::user()->id,
 				'client_name' => $request->client_name,
 				'client_email' => $request->client_email,
 				'client_phone' => $request->client_phone,
 				'company_name' => $request->company_name,
 				'client_address' => $request->client_address,
 				'image' => $this->addImage($request),
 			]); 

 			return response(['success'=>true, 'message'=>'Successfully a client has been added']);

 		}catch(Exception $e){

            $code = $e->getCode();           
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
           $upload_path='uploads/clients/';
           $image_url=$upload_path.$name;
           $img->save($image_url); 
           $path = $image_url;
		}
		else
		{
			$path = NULL;  
		}

		return $path;
	}

	public function update($request,$client)
	{
		try
		{
			$client->client_name = $request->client_name;
			$client->client_email = $request->client_email;
			$client->client_phone = $request->client_phone;
			$client->company_name = $request->company_name;
			$client->client_address = $request->client_address;
			$client->image = $this->updateImage($request,$client);
			$client->update();

			return response(['success'=>true, 'message'=>'Successfully the client has been updated']);

		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
	}


	public function updateImage($request,$client)
	{
 	    if($request->image && checkPathClient($request,$client))  
		{
		   $position = strpos($request->image, ';');
           $sub=substr($request->image, 0 ,$position);
           $ext=explode('/', $sub)[1];
           $name=time().".".$ext;
           $img=Image::make($request->image);
           if($client->image != NULL)
           {
           	   $this->imgPath($client);
           }
           
           $upload_path='uploads/clients/';
           $image_url=$upload_path.$name;
           $img->save($image_url); 
           $path = $image_url;
		}
		else
		{
			$path = $client->image;  
		}

		return $path;
	}

	public function imgPath($client)
    {
    	$parsedUrl = parse_url($client->image);
		$imagePath = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';

		if ($imagePath && File::exists(public_path($imagePath))) {
		    File::delete(public_path($imagePath));
		} 
    }

    public function delete($client)
    {
    	try
    	{
    		if($client->image != NULL)
			{
				$this->imgPath($client);
			}

            $client->delete();

            return response(['success'=>true, 'message'=>'Successfully the client has been deleted']);

    	}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

 }