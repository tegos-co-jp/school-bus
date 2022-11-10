<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class SchoolGroupResource extends JsonResource
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
            'created_at' => (new Carbon($this->created_at))->format('Y/n/j'),
            'updated_at' => is_null($this->updated_at) ? $this->updated_at : (new Carbon($this->updated_at))->format('Y/n/j'),
            ];
    }


}
