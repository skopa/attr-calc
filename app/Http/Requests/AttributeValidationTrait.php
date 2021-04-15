<?php


namespace App\Http\Requests;


trait AttributeValidationTrait
{
    /**
     * @param string $key
     * @return string
     */
    public function attributeRules(string $key): string
    {
        return resolve('attributes')->get($key)->rule;
    }
}
