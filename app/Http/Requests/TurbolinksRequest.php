<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurbolinksRequest extends FormRequest
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
            //
        ];
    }

    public function response(array $errors)
    {
        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->with('_turbolinks_location', $this->getRedirectUrl())
            ->withErrors($errors, $this->errorBag);
    }
}
