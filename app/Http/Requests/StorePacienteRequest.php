<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nombre' => ['required','string','max:100'],
            'edad'   => ['required','integer','min:0','max:150'],
            'email'  => ['required','email','max:150'],
            'telefono' => ['nullable','string','max:30'],
            'fecha_nacimiento' => ['nullable','date'],
            'notas' => ['nullable','string','max:1000'],
        ];
    }
}
