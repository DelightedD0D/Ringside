<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suspension extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['suspended_at', 'ended_at'];

    /**
     * TODO: Find out what I should do about type for date.
     * REVIEW: Find out if this is the right class to handle this method.
     * Lifts a wrestler's suspension.
     *
     * @param string $date Datetime that represents the date and time the wrestler was renewed.
     * @return bool
     */
    public function lift($date = null)
    {
        return $this->update(['ended_at' => $date ?: $this->freshTimestamp()]);
    }
}
