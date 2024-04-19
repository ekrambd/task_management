<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\Task\TaskInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $task;

    public function __construct(TaskInterface $task)
    {
        $this->task = $task;
    }

    public function index(Request $request)
    {
        $tasks = $this->task->fetch($request)->latest()->paginate(10);

        return response()->json([
            'success' => $tasks->total() > 0,
            'message' => $tasks->total() > 0 ? 'Data found' : 'No data found',
            'total' => $tasks->total(),
            'data' => $tasks
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
    public function store(StoreTaskRequest $request)
    {
        $storeTask = $this->task->store($request);
        return $storeTask;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return response()->json(['success'=>true, 'data'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $updateTask = $this->task->update($request,$task);
        return $updateTask;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $deleteTask = $this->task->delete($task);
        return $deleteTask;
    }
}
