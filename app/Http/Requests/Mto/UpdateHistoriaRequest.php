<?php

namespace App\Http\Requests\Mto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        \Log::info($this);

        return [

            'motivo'         => ['nullable', 'string'],
            'juicio'         => ['nullable', 'string'],
            'tratamiento'    => ['nullable', 'string'],
            'exploracion'    => ['nullable', 'string'],
            'informe'        => ['boolean'],
            'diagnosticado'  => ['boolean'],
            'empleado_id'    => ['nullable','integer'],

        ];
    }
}
