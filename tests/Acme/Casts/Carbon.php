<?php

namespace Laravie\Codex\Filter\Tests\Acme\Casts;

use Laravie\Codex\Filter\Cast;

class Carbon extends Cast
{
    /**
     * Is value a valid object.
     *
     * @param  mixed  $value
     */
    protected function isValid($value): bool
    {
        return $value instanceof \DateTimeInterface;
    }

    /**
     * Cast value from object.
     *
     * @param  object  $value
     * @return mixed
     */
    protected function fromCast($value)
    {
        return $value->format('Y-m-d');
    }

    /**
     * Cast value to object.
     *
     * @param  object  $value
     * @return mixed
     */
    protected function toCast($value)
    {
        return new \DateTime($value);
    }
}
