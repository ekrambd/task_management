<?php
 namespace App\Repositories\Designation;

 interface DesignationInterface
 {
 	public function fetch($request);
 	public function store($request);
 	public function update($request,$designation);
 	public function delete($designation);
 	public function statusUpdate($request);
 }