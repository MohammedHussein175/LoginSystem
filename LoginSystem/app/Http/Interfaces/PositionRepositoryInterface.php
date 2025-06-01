<?php
namespace App\Http\Interfaces;
use Illuminate\Http\Request;

interface PositionRepositoryInterface
{
    public function GetAllPositions();

    public function GetPositionByID($id);

    public function AddNewPosition(Request $request);

    public function UpdatePositionByID($id, Request $request);

    public function DeletePositionByID($id);
}
