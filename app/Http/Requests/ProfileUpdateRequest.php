<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['string', 'max:20'],
            'address' => ['string', 'max:500'],
            'city' => ['string', 'max:100'],
            'state' => ['string', 'max:100'],
            'postal_code' => ['string', 'max:20'],
            'country' => ['string', 'max:100'],
        ];
    }
}
