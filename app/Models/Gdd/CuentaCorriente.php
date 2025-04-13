<?php

namespace App\Models\Gdd;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class CuentaCorriente extends Model
{
    protected $table = 'RAFAM_CC';
    protected $primaryKey = null;

    protected function keyID(): Attribute
    {
        return new Attribute(
            get: fn() => $this->IMPONIBLE . '-' . $this->ANIO . '-' . $this->CUOTA,
        );
    }
}
