<?php

namespace App\Http\Controllers;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $users = $this->user->fetch($request)->latest()->paginate(10);

        return response()->json([
            'success' => $users->total() > 0,
            'message' => $users->total() > 0 ? 'Data found' : 'No data found',
            'total' => $users->total(),
            'data' => $users
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
    public function store(StoreEmployeeRequest $request)
    {
        $storeUser = $this->user->store($request);
        return $storeUser;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   
        $data = User::with('userinfo')->findorfail($user->id);
        return response()->json(['success'=>true, 'data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, User $user)
    {
        $updateUser = $this->user->update($request,$user);
        return $updateUser;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleteUser = $this->user->delete($user);
        return $deleteUser;
    }
}
