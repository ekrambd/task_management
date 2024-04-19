<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Repositories\Designation\DesignationInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $designation;

    public function __construct(DesignationInterface $designation)
    {
        $this->designation = $designation;
    }

    public function index(Request $request)
    {
        $designations = $this->designation->fetch($request)->where('user_id',auth()->user()->id)->latest()->paginate(10);

        return response()->json([
            'success' => $designations->total() > 0,
            'message' => $designations->total() > 0 ? 'Data found' : 'No data found',
            'total' => $designations->total(),
            'data' => $designations
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
    public function store(StoreDesignationRequest $request)
    {
        $storeDesignation = $this->designation->store($request);
        return $storeDesignation;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        return response()->json(['success'=>true, 'designation'=>$designation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDesignationRequest $request, Designation $designation)
    {
        $updateDesignation = $this->designation->update($request,$designation);
        return $updateDesignation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $deleteDesignation = $this->designation->delete($designation);
        return $deleteDesignation;
    }
}
