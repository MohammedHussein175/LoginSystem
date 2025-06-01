<?php

namespace App\Http\Interfaces;
use Illuminate\Http\Request;

interface DepartmentRepositoryInterface
{
    public function GetAllDepartment();

    public function GetDepartmentByID($id);
    public function AddNewDepartment(Request $request);

    public function UpdateDepartmentByID($id, Request $request);

    public function DeleteDepartmentByID($id);


}
