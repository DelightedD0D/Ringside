<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wrestler extends Model
{
    protected $guarded = [];

    public function getFormattedHeightAttribute()
    {
        $feet = floor($this->height / 12);
        $inches = ($this->height%12);

        return $feet . '\'' . $inches . '"';
    }
}
