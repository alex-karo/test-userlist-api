<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    const USERS_RESOURCE = "/users";
    const USERS_TABLE = "people";

    /**
     * Get data test
     *
     * @return void
     */
    public function testGetData()
    {
        $this->json('GET', self::USERS_RESOURCE)
            ->seeJsonStructure([
                '*' => ['id', 'name']
            ]);
        $this->json('GET', self::USERS_RESOURCE . "/1")
            ->seeJson([
                'id' => 1,
                'name' => 'Mark'
            ]);
        $this->get(self::USERS_RESOURCE . "/0")
            ->assertResponseStatus(404);
        $this->get(self::USERS_RESOURCE . "/who?")
            ->assertResponseStatus(404);
    }

    /**
     * Test add, modify and delete user
     *
     * @return void
     */
    public function testModifyData() {
        // Add
        $userId = $this->json('POST', self::USERS_RESOURCE . "/", ['name' => 'Alex'])
            ->assertResponseStatus(200)
            ->seeJsonStructure(['id', 'name'])
            ->decodeResponseJson()['id'];

        // Check
        $this->json('GET', self::USERS_RESOURCE . "/$userId")
            ->seeJson([
                'id' => $userId,
                'name' => 'Alex'
            ]);
        $this->seeInDatabase(self::USERS_TABLE, [
            'name' => 'Alex'
        ]);

        // Modify
        $this->json('PATCH', self::USERS_RESOURCE . "/$userId", ['name' => 'Peter'])
            ->assertResponseStatus(200)
            ->seeJson(['name' => 'Peter']);

        // Check
        $this->json('GET', self::USERS_RESOURCE . "/$userId")
            ->seeJson(['name' => 'Peter']);
        $this->seeInDatabase(self::USERS_TABLE, [
            'name' => 'Peter'
        ]);

        // Delete
        $this->json('DELETE', self::USERS_RESOURCE . "/$userId")
            ->assertResponseStatus(204);

        // Check
        $this->get(self::USERS_RESOURCE . "/$userId")->assertResponseStatus(404);
        $this->notSeeInDatabase(self::USERS_TABLE, ['id' => $userId]);
    }
}
