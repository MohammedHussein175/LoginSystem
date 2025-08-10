<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;

interface EmployeeRepositoryInterface
{
    public function GetAllEmployees();

    public function GetEmployeeByID($id);

    public function AddNewEmployee(Request $request);

    public function UpdateEmployeeByID($id,Request $request);

    public function DeleteEmployeeByID($id);
}
