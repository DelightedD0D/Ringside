<?php

namespace Tests\Unit;

use App\Arena;
use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArenaTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_arena_holds_an_event()
    {
        $arena = factory(Arena::class)->create();
        $event = factory(Event::class)->create(['arena_id' => $arena->id]);

        $this->assertInstanceOf(Event::class, $arena->events->first());
        $this->assertEquals($event->id, $arena->events->first()->id);
    }
}
