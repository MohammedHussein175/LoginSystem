<?php

namespace App\Http\Controllers;

use App\Http\Eloquent\AttendanceLogRepository;
use App\Http\Eloquent\EmployeeRepository;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $employeeRepository;
    public function __construct(EmployeeRepository $employeeRepository)
    {
       return $this->employeeRepository = $employeeRepository;
    }

    public function GetAll()
    {
        return $this->employeeRepository->GetAllEmployees();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddNew(Request $request)
    {

       return $this->employeeRepository->AddNewEmployee($request);


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function FindByID(Request $request)
    {


       return $this->employeeRepository->GetEmployeeByID($request->id);


    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateByID(Request $request)
    {

       return $this->employeeRepository->UpdateEmployeeByID($request->id,$request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteByID(request $request)
    {
        return $this->employeeRepository->DeleteEmployeeByID($request->id);

    }

    public function GetAllLog(Request $request)
    {
      return $this->employeeRepository->GetAllLog($request);
    }
}
