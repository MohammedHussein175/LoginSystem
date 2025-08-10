<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function GetAllUsers();

    public function GetUserByID($id);

    public function AddNewUser(Request $request);

    public function UpdateUserByID($id,Request $request);

    public function DeleteUserByID($id);
}
