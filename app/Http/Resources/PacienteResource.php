<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PacienteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)($this->_id ?? $this->id),
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'fecha_nacimiento' => optional($this->fecha_nacimiento)->toDateString(),
            'notas' => $this->notas,
            'created_at' => optional($this->created_at)->toISOString(),
            'updated_at' => optional($this->updated_at)->toISOString(),
        ];
    }
}
