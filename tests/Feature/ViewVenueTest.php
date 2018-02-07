<?php

namespace Tests\Feature;

use EventFactory;
use MatchFactory;
use Tests\TestCase;
use App\Models\Venue;
use App\Models\Wrestler;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewVenueTest extends TestCase
{
    use DatabaseMigrations;

    private $venue;

    public function setUp()
    {
        parent::setUp();

        $this->setupAuthorizedUser('show-venue');

        $this->venue = factory(Venue::class)->create([
            'name' => 'Venue Name',
            'address' => '123 Main Street',
            'city' => 'Laraville',
            'state' => 'FL',
            'postcode' => '90210'
        ]);
    }

    /** @test */
    public function users_who_have_permission_can_view_a_venue()
    {
        $response = $this->actingAs($this->authorizedUser)
                        ->get(route('venues.show', $this->venue->id));

        $response->assertSuccessful();
        $response->assertViewIs('venues.show');
        $response->assertViewHas('venue');
    }

    /** @test */
    public function users_who_dont_have_permission_cannot_view_a_venue()
    {
        $response = $this->actingAs($this->unauthorizedUser)
                        ->get(route('venues.show', $this->venue->id));

        $response->assertStatus(403);
    }

    /** @test */
    public function guests_cannot_view_a_venue()
    {
        $response = $this->get(route('venues.show', $this->venue->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function venues_past_events_can_be_viewed_on_venue_page()
    {
        $event = EventFactory::create(['name' => 'Event Name', 'venue_id' => $this->venue->id]);
        MatchFactory::create(['event_id' => $event->id], factory(Wrestler::class, 2)->create());

        $response = $this->actingAs($this->authorizedUser)
                        ->get(route('venues.show', $this->venue->id));

        $response->assertSuccessful();
        $response->assertViewIs('venues.show');
        $response->assertViewHas('venue');
        $response->assertSee('Event Name');
    }
}
