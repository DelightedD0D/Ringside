<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WrestlerSuspension extends Model
{
    protected $guarded = [];

    protected $table = 'wrestler_suspensions';

    protected $dates = ['suspended_at', 'ended_at'];

    public function renew()
    {
        return $this->update(['ended_at' => Carbon::now()]);
    }
}
