<?php

namespace App\Http\Requests;
use App\Rules\CpfValidateRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'nomecompleto'          => 'required',
            'nome'                  => 'required',
            'cpf'                   => ['required', 'unique:users,cpf,'. ($userId ? $userId->id : null), new CpfValidateRule()],
            'municipio_id'          => 'required',
            'unidadeatendimento_id' => 'required',
            'cargo'                 => 'required',
            'fone'                  => 'required',
            'perfil'                => 'required',
            'email'                 => 'required|email|unique:users,email,' . ($userId ? $userId->id : null),
            'password'              => 'required_if:password,!=,null|min:6|confirmed',
            'password_confirmation' => 'required',
            'ativo'                 => 'required'
        ];
    }

    public function messages(): array
    {
        return[
            'nomecompleto.required'             => 'O campo Nome Completo é obrigatório!',
            'nome.required'                     => 'O campo Nome é obrigatório!',
            'cpf.required'                      => 'O campo CPF é obrigatório!',
            'cpf.unique'                        => 'Este CPF já está cadastrado!',
            'municipio_id.required'             => 'O campo Município é obrigatório!',
            'unidadeatendimento_id.required'    => 'o campo Unidade de Atendiemnto é obrigatório!',
            'cargo.required'                    => 'O campo Cargo é obrigatório!',
            'fone.required'                     => 'O campo Telefone é obrigatório!',
            'perfil.required'                   => 'O campo Perfil é obrigatório!',
            'email.required'                    => 'O campo Email é obrigatório!',
            'email.email'                       => 'O campo Email precisa ser válido!',
            'email.unique'                      => 'Este Email já está cadastrado!',
            'password.required_if'              => 'O campo Senha é obrigatório!',
            'password.min'                      => 'O campo Senha, deve ter pelo menos 6 carcteres',
            'password.confirmed'                => 'O campo Senha difere da Confirmação de Senha!',
            'ativo.required'                    => 'O campo Ativo é obrigatório!',
        ];
    }


}
