<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\SchoolResource;
class SchoolYearResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'year' => $this->year,
            'start_on' => $this->start_on->format('Y/m/d'),
            'end_on' => $this->end_on->format('Y/m/d'),
            'this_year' => $this->this_year,
            'school' => (new SchoolResource($this->school)),
        ];
    }
}
