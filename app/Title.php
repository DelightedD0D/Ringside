<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;

class Title extends Model
{
    protected $dates = ['introduced_at', 'retired_at'];

    public function champions()
    {
        return $this->hasMany(TitleHistory::class);
    }

    public function matches()
    {
        return $this->belongsToMany(Match::class)->with('event');
    }

    public function scopeValid($query, $date)
    {
        return $query->where('introduced_at', '<=', $date)->where('retired_at', '>', $date);
    }

    public function setNewChampion($wrestler, $date = null)
	{
		if(! $date) {
			$date = Carbon::now();
		}

    	if($formerChampion = $this->getCurrentChampion()) {
			$formerChampion->loseTitle($this, $date);
		}

		$wrestler->winTitle($this, $date);
    }

    public function getFormattedIntroducedAtAttribute()
    {
        return $this->introduced_at->format('F j, Y');
    }

    public function getFormattedRetiredAtAttribute()
    {
        return $this->retired_at->format('F j, Y');
    }

    public function getLongestTitleReignAttribute()
    {
        return 'longest title reign';
    }

    public function getMostTitleDefensesAttribute()
    {
        return 'most title defenses';
    }

    public function getMostTitleReignsAttribute()
    {
        return 'most title reigns';
    }

	public function getCurrentChampion() {
		return $this->champions()->whereNull('lost_on')->first() ? $this->champions()->whereNull('lost_on')->first()->wrestler : null;
    }
}
