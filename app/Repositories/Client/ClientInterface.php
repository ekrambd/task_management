<?php
 namespace App\Repositories\Client;

 interface ClientInterface
 {
 	public function fetch($request);
 	public function store($request);
 	public function update($request,$client);
 	public function delete($client);
 }