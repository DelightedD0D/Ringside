<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteEventTest extends TestCase
{
    use RefreshDatabase;

    private $event;

    public function setUp()
    {
        parent::setUp();

        $this->setupAuthorizedUser('delete-event');

        $this->event = factory(Event::class)->create();
    }

    /** @test */
    public function users_who_have_permission_can_delete_a_event()
    {
        $response = $this->actingAs($this->authorizedUser)
                        ->from(route('events.index'))
                        ->delete(route('events.destroy', $this->event->id));

        $response->assertStatus(302);
        $this->assertSoftDeleted('events', $this->event->toArray());
        $response->assertRedirect(route('events.index'));
    }

    /** @test */
    public function users_who_dont_have_permission_cannot_delete_a_event()
    {
        $response = $this->actingAs($this->unauthorizedUser)
                        ->from(route('events.index'))
                        ->delete(route('events.destroy', $this->event->id));

        $response->assertStatus(403);
    }

    /** @test */
    public function guests_cannot_delete_a_event()
    {
        $response = $this->from(route('events.index'))
                        ->delete(route('events.destroy', $this->event->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }
}
