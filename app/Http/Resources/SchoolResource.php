<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        \Log::debug($request);

    //    return parent::toArray($request);
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'zip_code' => $this->zip_close,
            'address' => $this->address,
            'representative_name' => $this->representative_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
        ];
    }


}
