<?php

namespace App\Http\Requests;

use App\Models\Submission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CoachRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_type' => ['required', Rule::in(array_keys(Submission::DOCUMENT_TYPES))],
            'target_role' => ['required', 'string', 'min:2', 'max:100'],
            'mode' => ['required', Rule::in(array_keys(Submission::MODES))],
            'input_text' => ['required', 'string', 'min:100', 'max:20000'],
        ];
    }

    public function messages(): array
    {
        return [
            'document_type.required' => 'Choose whether this is a resume or a cover letter.',
            'document_type.in' => 'Choose whether this is a resume or a cover letter.',
            'target_role.required' => 'Tell the coach what role you are targeting.',
            'target_role.min' => 'That role name is too short to be useful.',
            'mode.required' => 'Choose whether you want feedback or a rewrite.',
            'mode.in' => 'Choose whether you want feedback or a rewrite.',
            'input_text.required' => 'Paste the text you want reviewed.',
            'input_text.min' => 'Paste at least 100 characters so the coach has something to work with.',
            'input_text.max' => 'That is longer than 20,000 characters. Trim it down and try again.',
        ];
    }
}
