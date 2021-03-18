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
                'mark' => $this->resource->mark->name,
                'name' => $this->resource->name,
                'quantity' => $this->resource->quantity,
                'date_shipment' => $this->resource->date_shipment->format('d/m/Y h:i A'),
                'observation' => $this->resource->observation,
            ]
        ];
    }
}
