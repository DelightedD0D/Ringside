<?php

use App\Models\Event;

class EventFactory
{
    public static function create($overrides = [], $matches = [], $totalNumberOfMatches = 8)
    {
        $event = factory(Event::class)->create($overrides);

        // $numberOfMatchesToGenerate = $totalNumberOfMatches - count($matches);

        // if ($numberOfMatchesToGenerate == 0) {
        //     $matchNumber = 1;
        //     foreach ($matches as $match) {
        //         $match->update(['event_id' => $event->id, 'match_number' => $matchNumber]);
        //         $matchNumber++;
        //     }
        // } else {
        //     $matchNumber = 1;
        //     foreach ($matches as $match) {
        //         $match->update(['event_id' => $event->id, 'match_number' => $matchNumber]);
        //         $matchNumber++;
        //     }
        //     $matchNumber = count($matches) + 1;
        //     for ($matchNumber; $matchNumber <= $totalNumberOfMatches; $matchNumber++) {
        //         MatchFactory::create(['event_id' => $event->id, 'match_number' => $matchNumber]);
        //     }
        // }

        return $event;
    }
}
