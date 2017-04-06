<?php

namespace Tests\Unit;

use App\Match;
use App\MatchType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MatchTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_match_must_have_a_type()
    {
        $type = factory(MatchType::class)->create();
        $match = factory(Match::class)->create(['match_type_id' => $type->id]);

        $this->assertEquals($match->type->id, $type->id);
    }

    /** @test */
    public function a_match_can_have_a_title_competed_in_it()
    {
        $title = factory(MatchType::class)->create();
        $match = factory(Match::class)->create(['title_id' => $title->id]);

        $this->assertEquals($match->title_id, $title->id);
    }
}
