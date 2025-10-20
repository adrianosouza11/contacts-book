<?php

declare(strict_types = 1);

namespace Tests\Feature;

use App\Models\ContactBook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_should_save_contact_successfully() : void
    {
        $payload = [
            'contact_name' => 'Adriano Oliveira',
            'contact_phone' => '31999855214',
            'contact_email' => 'adriano.oliveira@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->postJson('/api/contacts', $payload, [
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'status',
            'data'
        ]);

        $response->assertJson([
            'status' => 'CREATED',
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_reject_invalid_contact_email_param() : void
    {
        $payload = [
            'contact_name' => 'Adriano Oliveira',
            'contact_phone' => '31999855214',
            'contact_email' => 'com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->postJson('/api/contacts', $payload, [
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The contact email field must be a valid email address.',
            'errors' => [
                'contact_email' => ['The contact email field must be a valid email address.'],
            ]
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_must_reject_existing_contact_email_param() : void
    {
        ContactBook::factory()->create([
            'contact_email' => 'jose.alves@gmail.com'
        ]);

        $payload = [
            'contact_name' => 'José Alves',
            'contact_phone' => '31999855214',
            'contact_email' => 'jose.alves@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->postJson('/api/contacts', $payload, [
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'contact_email'
            ]
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_must_reject_existing_contact_phone_param() : void
    {
        ContactBook::factory()->create([
            'contact_phone' => '31999999999'
        ]);

        $payload = [
            'contact_name' => 'Adriano Phone',
            'contact_phone' => '31999999999',
            'contact_email' => 'adriano.phone@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->postJson('/api/contacts', $payload, [
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'contact_phone'
            ]
        ]);
    }
}
