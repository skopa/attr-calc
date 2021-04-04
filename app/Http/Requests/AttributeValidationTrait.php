<?php


namespace App\Http\Requests;


use App\Models\Attribute;

trait AttributeValidationTrait
{
    /**
     * @param string $key
     * @return string
     */
    public function attributeRules(string $key): string
    {
        /** @var Attribute $attribute */
        $attribute = resolve('attributes')->get($key);
        //dd($attribute);
        return $attribute->getRules();
    }
}
