<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePacienteRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes','string','max:100'],
            'edad'   => ['sometimes','integer','min:0','max:150'],
            'email'  => ['sometimes','email','max:150'],
            'telefono' => ['sometimes','nullable','string','max:30'],
            'fecha_nacimiento' => ['sometimes','nullable','date'],
            'notas' => ['sometimes','nullable','string','max:1000'],
        ];
    }
}
