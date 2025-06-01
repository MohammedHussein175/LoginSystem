<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request):array
    {
        return ['id' => $this->id , // استخدام null كقيمة افتراضية
            'name' => $this->first_name,
            'phone' => $this->phone,
            ];

    }
}
