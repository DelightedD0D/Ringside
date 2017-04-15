<?php

namespace App;

use App\Exceptions\MatchesHaveSameMatchNumberAtEventException;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $dates = ['date'];

    public function getFormattedDateAttribute()
    {
        return $this->date->format('F jS, Y');
    }

    public function matches()
    {
        return $this->hasMany(Match::class)
                ->with('type', 'referees', 'stipulations', 'wrestlers', 'titles');
    }

    public function arena()
    {
        return $this->belongsTo(Arena::class);
    }

    public function addMatches($matches)
    {
        if($matches instanceof Match) {
            $matches = collect([$matches]);
        } else if(is_array($matches) && array_key_exists('match_number',$matches)) {
            $matches = collect([Match::create($matches)]);
        } else if(is_array($matches) && $matches[0] instanceof Match) {
            $matches = collect($matches);
        } else if(is_array($matches) && is_array($matches[0])) {
            $matches = collect($matches)->map(function($match) {
                return Match::create($match);
            });
        }

        try {
            $this->matches()->saveMany($matches->all());
        } catch (\PDOException $e) {
            throw new MatchesHaveSameMatchNumberAtEventException;
        }
    }
}
