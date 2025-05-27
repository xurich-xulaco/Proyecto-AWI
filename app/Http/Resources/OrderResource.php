<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'usuario'   => $this->user->name,
            'status'    => $this->status,
            'total'     => $this->total,
            'detalles'  => DetalleResource::collection($this->detalles),
            'creado_en' => $this->created_at->toDateTimeString(),
        ];
    }
}
