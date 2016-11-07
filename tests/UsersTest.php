<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Get data test
     *
     * @return void
     */
    public function testGetData()
    {
        $this->json('GET', '/users/')
            ->seeJsonStructure([
                '*' => ['id', 'name']
            ]);
        $this->json('GET', '/users/1')
            ->seeJson([
                'id' => 1,
                'name' => 'Mark'
            ]);
        $this->get('/users/0')
            ->assertResponseStatus(404);
        $this->get('/users/who?')
            ->assertResponseStatus(404);
    }

    /**
     * Test add, modify and delete user
     *
     * @return void
     */
    public function testModifyData() {
        // Add
        $userId = $this->json('POST', '/users/', ['name' => 'Alex'])
            ->assertResponseStatus(200)
            ->seeJsonStructure(['id', 'name'])
            ->decodeResponseJson()['id'];

        // Check
        $this->json('GET', "/users/$userId")
            ->seeJson([
                'id' => $userId,
                'name' => 'Alex'
            ]);
        $this->seeInDatabase('people', [
            'name' => 'Alex'
        ]);

        // Modify
        $this->json('PATCH', "/users/$userId", ['name' => 'Peter'])
            ->assertResponseStatus(200)
            ->seeJson(['name' => 'Peter']);

        // Check
        $this->json('GET', "/users/$userId")
            ->seeJson(['name' => 'Peter']);
        $this->seeInDatabase('people', [
            'name' => 'Peter'
        ]);

        // Delete
        $this->json('DELETE', "/users/$userId")
            ->assertResponseStatus(204);

        // Check
        $this->get("/users/$userId")->assertResponseStatus(404);
        $this->notSeeInDatabase('people', ['id' => $userId]);
    }
}
