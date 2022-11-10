<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\SchoolGroupResource;


class SchoolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
    //    return parent::toArray($request);
    return [
        'id' => $this->id,
        'code' => $this->code,
        'name' => $this->name,
        'short_name' => $this->short_name,
        'zip_code' => is_null($this->zip_code) ? "" : $this->zip_close,
        'address' => is_null($this->address) ? "" : $this->address,
        'reception_finish_time' => is_null($this->reception_finish_time) ? "" : $this->reception_finish_time,
        'phone_number' => is_null($this->phone_number) ? "" : $this->phone_number,
        'created_at' => (new Carbon($this->created_at))->format('Y/n/j'),
        'updated_at' => is_null($this->updated_at) ? $this->updated_at : (new Carbon($this->updated_at))->format('Y/n/j'),
        'school_group' => (new SchoolGroupResource($this->school_group)),
    ];
    }


}
