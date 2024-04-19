<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Repositories\Department\DepartmentInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $department;

    public function __construct(DepartmentInterface $department)
    {
        $this->department = $department;
    }

    public function index(Request $request)
    {
        $departments = $this->department->fetch($request)->latest()->paginate(10);

        return response()->json([
            'success' => $departments->total() > 0,
            'message' => $departments->total() > 0 ? 'Data found' : 'No data found',
            'total' => $departments->total(),
            'data' => $departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
        $storeDepartment = $this->department->store($request);
        return $storeDepartment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return response()->json(['success'=>true, 'data'=>$department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $updateDepartment = $this->department->update($request,$department);
        return $updateDepartment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $deleteDepartment = $this->department->delete($department);
        return $deleteDepartment;
    }
}
