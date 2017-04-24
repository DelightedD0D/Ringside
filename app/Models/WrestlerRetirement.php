<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WrestlerRetirement extends Model
{
    protected $guarded = [];

    protected $table = 'wrestler_retirements';

    public function unretire($date)
    {
        return $this->update(['ended_at' => $date]);
    }
}
