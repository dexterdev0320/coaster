<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Employee as employee;
class SeatStatus extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'seat_no' => $this->seat_no,
            'emp_id' => ($this->employee) ? $this->employee->emp_id : null,
            'code' => $this->code,
            'dest_id' => $this->dest_id,
            'status' => $this->status,
            'day' => $this->day
        ];
    }
}
