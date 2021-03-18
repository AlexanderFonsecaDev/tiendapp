<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarkResource extends JsonResource
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
            'type' => 'marks',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [
                'name'      => $this->resource->name,
                'reference' => $this->resource->reference,
                'created_at' => $this->resource->created_at->format('d/m/Y h:i A')
            ]
        ];
    }
}
