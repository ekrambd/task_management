<?php
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;

function checkPathClient($request,$client)
{
	 $img = $request->image;
	 if($client->image != $img)
	 {
	 	 return true;
	 }
	 return false;
}

function checkPathUser($request,$user)
{
	 $img = $request->image;
	 if($user->image != $img)
	 {
	 	 return true;
	 }
	 return false;
}

function invoiceSubTotal($request)
{
	$sum = Project::where('client_id', $request->client_id)
                            ->whereNotIn('status', ['Pending', 'Cancel'])
                            ->sum('project_cost');

    return $sum;
}