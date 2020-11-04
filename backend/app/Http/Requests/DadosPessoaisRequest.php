<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DadosPessoaisRequest extends FormRequest
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
        return [
            'nome' => 'required',
            'rg' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
            'nome_mae' => 'required',
            'nome_pai' => 'required',
            'data_nascimento' => 'required',
            'municipio_nascimento' => 'required',
            'sexo' => 'required',
            'cutis' => 'required',
            'tipo_sanguineo' => 'required',
            'estado_civil' => 'required',
            'profissao' => 'required',
            'escolaridade' => 'required',
            'nome_conjuge' => 'required',
            'nome_filhos' => 'required',
            'titulo_eleitor' => 'required',
            'zona_eleitoral' => 'required',
            'cnh' => 'required',
            'tipo_cnh' => 'required',
            'validade_cnh' => 'required',
            'observacao' => 'required',
        ];
    }
}
