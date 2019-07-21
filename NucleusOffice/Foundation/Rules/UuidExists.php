<?php

namespace NucleusOffice\Foundation\Rules;

use Illuminate\Contracts\Validation\Rule;

class UuidExists implements Rule
{
    protected $model;

    /**
     * Create a new rule instance.
     *
     * @param $modelClass
     */
    public function __construct($modelClass)
    {
        $this->model = new $modelClass;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return $this->model::whereUuid($value)->first() ? true : false;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Uuid does not exists.';
    }
}
