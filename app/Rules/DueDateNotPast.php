<?php
// File: app/Rules/DueDateNotPast.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class DueDateNotPast implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $dueDate = Carbon::parse($value);
        return $dueDate->isFuture() || $dueDate->isToday() && $dueDate->greaterThanOrEqualTo(Carbon::now());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The due date must be a future date and time.';
    }
}
