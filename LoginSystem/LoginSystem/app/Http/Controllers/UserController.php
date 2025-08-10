<?php

namespace App\Http\Controllers;

use App\Http\Eloquent\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function GetAll()
    {
        return $this->userRepository->GetAllUsers();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddNew(Request $request)
    {
        return $this->userRepository->AddNewUser($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function FindByID(Request $request)
    {
        return $this->userRepository->GetUserByID($request->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateByID(Request $request)
    {
        return $this->userRepository->UpdateUserByID($request->id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteByID(Request $request)
    {
        return $this->userRepository->DeleteUserByID($request->id);
    }



}
