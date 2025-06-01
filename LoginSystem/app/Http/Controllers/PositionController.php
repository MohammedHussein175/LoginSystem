<?php

namespace App\Http\Controllers;

use App\Http\Eloquent\PositionRepository;
use App\Models\position;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PositionController extends Controller
{

    private $positionRepository;
    public function __construct(PositionRepository $positionRepository)
    {
        return $this->positionRepository = $positionRepository;
    }


    public function GetAll()
    {
       return $this->positionRepository->GetAllPositions();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddNew(Request $request)
    {
        return $this->positionRepository->AddNewPosition($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function FindByID(Request $request)
    {
       return $this->positionRepository->GetPositionByID($request->id);
    }

    /**
     * Display the specified resource.
     */
    public function DeleteByID(Request $request)
    {
        return $this->positionRepository->DeletePositionByID($request->id);
    }


    public function UpdateByID(Request $request)
    {
        return $this->positionRepository->UpdatePositionByID($request->id,$request);
    }

}
