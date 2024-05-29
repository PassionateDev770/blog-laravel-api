<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class AppFormRequest extends FormRequest
{
    /**
     * Return mixed
     *
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            //status' => 'error',
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ]);

        $response->setStatusCode(422);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
