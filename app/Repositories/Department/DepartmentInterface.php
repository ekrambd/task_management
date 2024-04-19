<?php
 namespace App\Repositories\Department;

 interface DepartmentInterface
 {
 	public function fetch($request);
 	public function store($request);
 	public function update($request,$department);
 	public function delete($department);
 	public function statusUpdate($request);
 }