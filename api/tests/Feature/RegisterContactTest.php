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

    /**
     * @test
     * @return void
     */
    public function it_should_update_contact_successfully()
    {
        $contact = ContactBook::factory()->create();

        $payload = [
            'contact_name' => 'Adriano Jhone',
            'contact_phone' => '31999999999',
            'contact_email' => 'adriano.jhone@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->putJson('/api/contacts/' . $contact->id, $payload, [
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'data'
        ]);

        $response->assertJson([
            'status' => 'UPDATED',
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_contact_not_found_when_update() : void
    {
        $payload = [
            'contact_name' => 'Adriano Jhone',
            'contact_phone' => '31999999999',
            'contact_email' => 'adriano.jhone@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->putJson('/api/contacts/2', $payload, [
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(404);

        $response->assertJsonStructure([
            'status',
            'message',
            'data'
        ]);

        $response->assertJson([
            'status' => 'CONTACT_NOT_FOUND',
            'message' => 'Not found contact to update',
            'data' => [
                'Not found contact to update'
            ]
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_delete_contact_successfully() : void
    {
        $contact = ContactBook::factory()->create();

        $response = $this->deleteJson('/api/contacts/' . $contact->id, [
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'status' => 'DELETED',
            'data' => true
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function it_list_contacts_with_pagination()
    {
        ContactBook::factory()->create(['contact_name' => 'Adriano Oliveira']);
        ContactBook::factory()->create(['contact_name' => 'Jonas Renner']);
        ContactBook::factory()->create(['contact_name' => 'Adriele Souza']);
        ContactBook::factory()->create(['contact_name' => 'Beatriz']);

        $response = $this->getJson('/api/contacts', [
            'accept' => 'application/json',
            'Content-Type' => 'application/json'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['contact_name' => 'Adriano Oliveira']);
        $response->assertJsonFragment(['contact_name' => 'Adriele Souza']);
        $response->assertJsonFragment(['contact_name' => 'Beatriz']);
        $response->assertJsonFragment(['contact_name' => 'Jonas Renner']);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_update_contact_with_same_contact_phone_param()
    {
       $contact =  ContactBook::factory()->create(['contact_phone' => '31991841552']);

        $payload = [
            'contact_name' => 'Adriano Jhone',
            'contact_phone' => '31991841552',
            'contact_email' => 'adriano.jhone@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->putJson('/api/contacts/' . $contact->id, $payload);

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function it_cannot_update_contact_when_existing_contact_phone_another_contact()
    {
        $contactOne =  ContactBook::factory()->create(['contact_phone' => '31991841552']);
        $contactTwo =  ContactBook::factory()->create(['contact_phone' => '31999855214']);

        $payload = [
            'contact_name' => 'Adriano Jhone',
            'contact_phone' => $contactTwo->contact_phone,
            'contact_email' => 'adriano.jhone@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->putJson('/api/contacts/' . $contactOne->id, $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['contact_phone']);
    }

    /**
     * @test
     * @return void
     */
    public function it_can_update_contact_with_same_contact_email_param()
    {
        $contact =  ContactBook::factory()->create(['contact_email' => 'adriano.oliveira@gmail.com']);

        $payload = [
            'contact_name' => 'Adriano Jhone',
            'contact_phone' => '31991841552',
            'contact_email' => 'adriano.oliveira@gmail.com',
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->putJson('/api/contacts/' . $contact->id, $payload);

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function it_cannot_update_contact_when_existing_contact_email_another_contact()
    {
        $adrianoContact =  ContactBook::factory()->create(['contact_email' => 'adriano.oliveira@gmail.com']);
        $adrieleContact =  ContactBook::factory()->create(['contact_phone' => 'adriele@outlook.com']);

        $payload = [
            'contact_name' => 'Adriano Jhone',
            'contact_phone' => '31999999999',
            'contact_email' => $adrieleContact->contact_email,
            'address' => 'Rua Carlos Lacerda',
            'number' => '941',
            'neighborhood' => 'Trevo',
            'city' => 'Belo Horizonte',
            'state' => 'MG',
            'postal_code' => '31545170',
        ];

        $response = $this->putJson('/api/contacts/' . $adrianoContact->id, $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['contact_email']);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_download_csv_contacts()
    {
        $response = $this->get('/api/contacts/export/csv');

        $response->assertStatus(200);

        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');

        $this->assertStringContainsString('attachment', $response->headers->get('Content-Disposition'));
    }
}
