<?php

namespace Jaspaul\SafeLinkValidator;

use Illuminate\Contracts\Validation\Rule;

class SafeLinkRule implements Rule
{
    /**
     * Determines if the provided link value is safe.
     *
     * @param string $attribute
     * @param string $value
     *
     * @return boolean
     */
    public function passes($attribute, $value)
    {
        return Link::fromString($value)->isSafe();
    }

    /**
     * The message to return when it failes.
     *
     * @return string
     */
    public function message()
    {
        return trans('safe-links::validation.link');
    }
}
