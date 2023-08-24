<?php

namespace Infrastructure\Eloquent\Traits;

use Illuminate\Support\Str;

trait SnakeCaseable
{
    public function getAttribute($key)
    {
        return parent::getAttribute(Str::snake($key));
    }

    public function setAttribute($key, $value)
    {
        return parent::setAttribute(Str::snake($key), $value);
    }
}
