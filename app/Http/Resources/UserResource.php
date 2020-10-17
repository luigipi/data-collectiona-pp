<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'date_of_birth' => $this->dob,
            'passport' => asset('/public/'.$this->passport),
            'created_at' => (string) $this->created_at->toFormattedDateString(),
            'family_members' => $this->family_members
        ];
    }
}
