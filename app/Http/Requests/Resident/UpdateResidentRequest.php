<?php

namespace App\Http\Requests\Residents;

use App\Models\Resident;
use Illuminate\Foundation\Http\FormRequest;

class UpdateResidentRequest extends FormRequest
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
        $uuid = request()->route('resident');
        $id = Resident::where('uuid', $uuid)->first()->user->id;

        return [
            'name' => 'required|string|min:3',
            'email' => "required|email|unique:users,email,{$id}",
            'cpf' => 'required|string|max:14',
            'birthday' => 'required|date_format:d/m/Y',
            'bloco' => 'required|string',
            'apartamento' => 'required|string',
            'tipo' => 'required|in:inquilino,proprietario,morador',
            'active' => 'required|boolean'
        ];
    }
}
