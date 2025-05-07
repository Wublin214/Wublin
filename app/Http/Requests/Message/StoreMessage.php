<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessage extends FormRequest
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
        return [
            'message' => 'required|string',
            'client_id' => 'nullable|integer|exists:clients,id',
            'master_id' => 'nullable|integer|exists:masters,id',
            'user_type' => 'required|in:client,master',
            'chat_id' => 'required|integer|exists:chats,id'
        ];

    }
}
