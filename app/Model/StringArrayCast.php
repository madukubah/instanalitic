<?php

namespace App\Model;


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class StringArrayCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        // return "tesss";
        // return json_decode(str_replace(['{', '}'], ['[', ']'], $value));
        $value =  str_replace(['{', '}'], ['', ''], $value);
        return explode( ",", $value );
        // return json_decode($value, true);
    }

    public function set($model, $key, $value, $attributes)
    {

        return str_replace(['[', ']'], ['{', '}'], json_encode($value));
    }
}
