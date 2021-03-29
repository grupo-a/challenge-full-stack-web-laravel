<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'id'  => $this->id,
            'name'  => $this->name,
            'email' => $this->email,
            'cpf'   => $this->cpf,
            'ra'    => $this->ra,
            'date_created' => Carbon::parse($this->created_at)->format('d/m/Y'),
        ];
    }
}
