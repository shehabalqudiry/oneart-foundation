<?php

namespace INTCore\OneARTFoundation\Http;

use Illuminate\Foundation\Http\FormRequest as Request;
use \Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class FormRequest extends Request {
    
    protected function failedValidation(Validator $validator)
    {
        if ($this->wantsJson()) {
            $errors = $this->BagBuilder($validator->errors());

            $response = response([
                'errors' => $errors
            ], 422);

        
            throw new ValidationException($validator, $response);

        }
        
        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());

        
    }


    public function BagBuilder($errors) {
        $errorsArray = $errors->getMessages();
        $errs = [];
        foreach ($errorsArray as $key => $errMsg) {
            $errs[] = $this->buildArray($key, $errMsg[0]);
        }

        return $errs;
    }


    private function buildArray($key, $error)
    {
        return [
            'name' => $key,
            'message' => $error,
        ];
    }
}