<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'sizes',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [
                'name'       => $this->resource->name,
                'created_at' => $this->resource->created_at->format('d/m/Y h:i A'),
            ]
        ];
    }
}
