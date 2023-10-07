<?php

namespace App\Http\Requests;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class FormRequestProfesores extends FormRequest
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
                'nombre_p' =>'required|max:100|min:3',
                'apellido_p' =>'required|max:100|min:3',
                'dni_p' => 'required|numeric|digits:7',
                'telefono_p' => 'required|numeric|digits:10',
                'curso_p' => 'required|exists:cursos,curso',
                'division_p' => 'required_with:curso||exists:cursos,division',
        ];
    }
}
