<?php
 namespace App\Repositories\Project;
 
 interface ProjectInterface
 {
 	public function fetch($request);
 	public function store($request);
 	public function update($request,$project);
 	public function delete($project);
 }