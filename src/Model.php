<?php

namespace INTCore\OneARTFoundation;

use Eloquent;
use Str;
/**
 * Base Model.
 */
class Model extends Eloquent
{

    public $incrementing = false;

    protected $keyType = "string";

    public static function boot() {
        parent::boot();

        self::creating(function ($model) {
            $model->id = Str::uuid();
        });
        
    }
}
