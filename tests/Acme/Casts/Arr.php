<?php

namespace Laravie\Codex\Filter\Tests\Acme\Casts;

use Laravie\Codex\Filter\Cast;

class Arr extends Cast
{
    /**
     * Is value a valid object.
     *
     * @param  mixed  $value
     */
    protected function isValid($value): bool
    {
        return \is_array($value);
    }

    /**
     * Cast value from object.
     *
     * @param  object  $value
     * @return mixed
     */
    protected function fromCast($value)
    {
        return json_encode($value);
    }

    /**
     * Cast value to object.
     *
     * @param  object  $value
     * @return mixed
     */
    protected function toCast($value)
    {
        return json_decode($value, true);
    }
}
