<?php

namespace App\Trait;

use Illuminate\Contracts\Validation\Validator;
trait HasStatusMessage
{
    public function StatusMessage(bool $status, string $message, ?string $route = null, array $errors = []){
        $redirect = ($status && $route) ? redirect()->route($route) : back();

        if(!$status){
            $redirect = $redirect->withErrors($errors)->withInput();
        }

        return $redirect->with($status ? 'success' : 'error', $message);
    }

    public function failedValidation(Validator $validator, string $message = "Error, Try Again!"){
        return $this->StatusMessage(false, $message, null, $validator->errors()->toArray());
    }
}
