<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'brand' => [
                'name' => $this->brand->name,
                'url' => $this->brand->url,
            ],
            'product_no' => $this->product_no,
            'scale' => $this->scal,
            'age' => $this->age,
            'level' => $this->level,
            'no_parts' => $this->no_parts,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'wingspan' => $this->wingspan,
            'url' => $this->url,
            'purchased_at' => $this->purchased_at,
            'finished_at' => $this->finished_at,
        ];
    }
}
