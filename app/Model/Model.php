<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Ramsey\Uuid\Uuid;

class Model extends EloquentModel
{
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }
}