<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GcmRequest extends FormRequest
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
            // -> dados pessoais
            'nome' => 'required|max:40',
            'rg' => 'required|max:15',
            'cpf' => 'required|unique:dados_pessoais,cpf',
            'telefone' => 'nullable|array',
            'nome_mae' => 'required|max:40',
            'nome_pai' => 'nullable|max:40',
            'data_nascimento' => 'required|date',
            'municipio_nascimento' => 'required|max:255',
            'sexo' => 'required|in:MASCULINO,FEMININO',
            'cutis' => 'nullable|in:BRANCO,PRETO,PARDO,AMARELO,INDIGENA',
            'tipo_sanguineo' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-,',
            'estado_civil' =>
                'nullable|in:SOLTEIRO,CASADO,SEPARADO,DIVORCIADO,VIUVO',
            'profissao' => 'nullable',
            'escolaridade' =>
                'nullable|in:FUNDAMENTAL-INCOMPLETO,FUNDAMENTAL-COMPLETO,MEDIO-INCOMPLETO,MEDIO-COMPLETO,SUPERIOR-INCOMPLETO,SUPERIOR-COMPLETO,POS-GRADUACAO-INCOMPLETO,POS-GRADUACAO-COMPLETO,MESTRADO',
            'nome_conjuge' => 'required_if:estado_civil,CASADO|nullable|max:20',
            'nome_filhos' => 'nullable|array',
            'titulo_eleitor' => 'required_with:zona_eleitoral|nullable|max:15',
            'zona_eleitoral' => 'required_with:titulo_eleitor|nullable|max:7',
            'cnh' =>
                'required_with_all:tipo_cnh,validade_cnh|nullable|string|max:15',
            'tipo_cnh' =>
                'required_with_all:cnh|in:ACC,A,B,C,D,E,AAC-B,ACC-C,ACC-D,ACC-E,A-B,A-C,A-D,A-E|nullable',
            'validade_cnh' => 'required_with_all:cnh|date|nullable',
            'observacao' => 'nullable',
            // -> bairro
            'nome_bairro' => 'required|max:255',
            'codigo_bairro' => 'nullable|max:6',
            'bairro_observacao' => 'nullable|string|max:255',
            'municipio' => 'required|string', // - uuid
            // -> endereco
            'logradouro' => 'required|max:200',
            'numero' => 'required|numeric',
            'complemento' => 'nullable|max:100',
            'codigo_endereco' => 'nullable|max:6',
            'cep' => 'nullable',
            // -> gcm
            'nome_guerra' => 'required',
            'atribuicao' =>
                'required|in:COMANDANTE,SUB_COMANDANTE,ADMINISTRATIVO,COI,SUPERVISOR,OFICIAL',
        ];
    }
}
