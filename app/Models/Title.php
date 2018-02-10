<?php

namespace App\Models;

use App\Traits\HasMatches;
use Illuminate\Database\Eloquent\Model;
use Laracodes\Presenter\Traits\Presentable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Title extends Model
{
    use HasMatches, Presentable, SoftDeletes;

    /**
     * Assign which presenter to be used for model.
     *
     * @var string
     */
    protected $presenter = 'App\Presenters\TitlePresenter';

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
    protected $dates = ['introduced_at', 'retired_at'];

    /**
     * A title can have many champions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function champions()
    {
        return $this->hasMany(Champion::class);
    }

    /**
     * A title can be added to many matches.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function matches()
    {
        return $this->belongsToMany(Match::class);
    }

    /**
     * TODO: Find out what I should do about type for date.
     * Crowns the new champion for the title.
     *
     * @param \App\Models\Wrestler $wrestler
     * @param datetime $date
     * @return void
     */
    public function setNewChampion(Wrestler $wrestler, $date)
    {
        if ($champion = $this->getCurrentChampion()) {
            $champion->loseTitle($this, $date);
        }

        $wrestler->winTitle($this, $date);
    }

    /**
     * Gets the current champion for the title.
     *
     * @return \App\Models\Wrestler|null
     */
    public function getCurrentChampion()
    {
        if ($champion = $this->champions()->current()) {
            return $champion->wrestler;
        }
    }

    /**
     * Scope a query to only include active titles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $date)
    {
        return $query->whereNull('retired_at')->where('introduced_at', '<=', $date);
    }

    /**
     * Scope a query to only retired titles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRetired($query)
    {
        return $query->whereNotNull('retired_at');
    }
}
