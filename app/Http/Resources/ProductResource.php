<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'type' => 'products',
            'id' => (string)$this->resource->getRouteKey(),
            'attributes' => [
                'size' => $this->resource->size->name,
                'size_id' => $this->resource->size->id,
                'mark' => $this->resource->mark->name,
                'mark_id' => $this->resource->mark->id,
                'name' => $this->resource->name,
                'quantity' => $this->resource->quantity,
                'date_shipment' => $this->resource->date_shipment->format('Y-m-d'),
                'observation' => $this->resource->observation,
            ]
        ];
    }
}
