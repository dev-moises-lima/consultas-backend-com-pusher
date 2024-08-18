<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Foto implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $extensaoDaFoto = $value->getClientOriginalExtension();
        $extensoesAceitas = ['jpg', 'jpeg', 'png'];

        if(!in_array($extensaoDaFoto, $extensoesAceitas)) {
            $fail('validation.foto')->translate();
        }
    }
}
