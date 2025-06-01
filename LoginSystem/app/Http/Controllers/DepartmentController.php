<?php

namespace App\Http\Controllers;

use App\Http\Eloquent\DepartmentRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DepartmentController extends Controller
{
    private $departmentRepository;
    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }
    public function GetAll()
    {
        return $this->departmentRepository->GetAllDepartment();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddNew(Request $request)
    {
        return $this->departmentRepository->AddNewDepartment($request);
    }

    public function FindByID(Request $request)
    {
        return $this->departmentRepository->GetDepartmentByID($request->id);
    }
    public function UpdateByID(Request $request)
    {
        return $this->departmentRepository->UpdateDepartmentByID($request->id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteByID(Request $request)
    {
        return $this->departmentRepository->DeleteDepartmentByID($request->id);
    }
}
