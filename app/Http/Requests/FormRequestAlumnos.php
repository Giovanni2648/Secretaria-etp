<?php

namespace App\Http\Requests;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FormRequestAlumnos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' =>'required|max:100|min:3',
            'apellido' =>'required|max:100|min:3',
            'edad' => 'required|numeric',
            'dni' => 'required|numeric|digits:7',
            'telefono' => 'required|numeric|digits:10',
            'nacimiento' => 'required',
            'curso' => 'required|exists:cursos,curso',
            'division' => 'required_with:curso||exists:cursos,division',
            'nombre_t' =>'required|max:100|min:3',
            'apellido_t' =>'required|max:100|min:3',
            'dni_t' => 'required|numeric|digits:7',
            'telefono_t' => 'required|numeric|digits:10',
        ];
    }
}
