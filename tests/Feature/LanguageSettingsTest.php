<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageSettingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test language settings page is accessible.
     */
    public function test_language_settings_page_is_accessible(): void
    {
        $user = \App\Models\User::factory()->create();
        $response = $this->actingAs($user)->get('/settings/language');
        $response->assertStatus(200);
        $response->assertViewIs('test_language');
    }

    /**
     * Test language can be updated.
     */
    public function test_language_can_be_updated(): void
    {
        $user = \App\Models\User::factory()->create(['native_language' => 'de']);
        $response = $this->actingAs($user)->put('/settings/language', ['native_language' => 'en']);
        
        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'native_language' => 'en',
        ]);
    }

    /**
     * Test locale is set from session or user profile.
     */
    public function test_locale_is_set_from_session_or_user_profile(): void
    {
        $user = \App\Models\User::factory()->create(['native_language' => 'fr']);
        $response = $this->actingAs($user)->get('/settings/language');
        
        $this->assertEquals('fr', app()->getLocale());
    }
}
