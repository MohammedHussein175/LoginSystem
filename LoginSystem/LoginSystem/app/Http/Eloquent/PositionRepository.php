<?php

namespace App\Http\Eloquent;

use App\Http\Interfaces\PositionRepositoryInterface;
use App\Models\position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionRepository implements PositionRepositoryInterface
{
    public function GetAllPositions()
    {
        $positions = position::all();
        return response()->json($positions);
    }

    public function AddNewPosition(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'position_name' => 'required|string|max:100|unique:positions,position_name',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $positionData = [
            'position_name' => $request->position_name,

        ];

        $position = Position::create($positionData);
        return response()->json(['position' => $position], 201);
    }

    public function GetPositionByID($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Position not found'], 404);
        }

         return response()->json($position);
    }

    public function DeletePositionByID($id)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Position not found'], 404);
        }


        $position->delete();
        return response()->json(['message' => 'Position deleted successfully'], 200);
    }

    public function UpdatePositionByID($id, Request $request)
    {
        $position = Position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Position not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'position_name' => 'required|string|max:100|unique:positions,position_name',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $position->update($request->all());
        return response()->json($position);
    }

}
