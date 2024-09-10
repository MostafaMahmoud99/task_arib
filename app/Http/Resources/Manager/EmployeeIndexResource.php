<?php

namespace App\Http\Resources\Manager;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $media_path = "";
        if ($this->media){
            $media_path = $this->media->file_path;
        }

        $manager_name = "";
        if ($this->Manager){
            $manager_name = $this->Manager->first_name." ".$this->Manager->last_name;
        }

        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "phone" => $this->phone,
            "salary" => $this->salary,
            "image" => $media_path,
            "full_name" => $this->first_name." ".$this->last_name,
            "manager_name" => $manager_name
        ];
    }
}
