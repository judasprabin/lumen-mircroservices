
<?php
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response;


class OwnerTest extends TestCase
{
    use DatabaseTransactions;


    public function testLogin()
    {

        $token = $this->loginApi();
        $this->seeStatusCode(200);
        $this->seeJson(["token_type" => "Bearer"]);


    }
    /**
     * /Owners [GET]
     */
    public function testShouldReturnAllOwners()
    {
        $response = $this->loginApi();
        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $this->get("/owners", $headers);
        $this->seeStatusCode(200);

        // $this->seeJsonStructure(
        //     ['data' =>
        //         [
        //         'name',
        //         'email',
        //         'address',
        //         'created_at',
        //         'updated_at',
        //     ]]
        // );

    }

    /**
     * /owners/id [GET]
     */
    public function testShouldReturnOwner()
    {
        $response = $this->loginApi();
        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $this->get("/owners/13", $headers);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                'name',
                'email',
                'address',
                'created_at',
                'updated_at',
            ]]
        );

    }

    /**
     * /Owners [POST]
     */
    public function testShouldCreateOwner()
    {
        $faker = Faker\Factory::create();

        $response = $this->loginApi();
        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $parameters = ['name' => 'test owner', 'email' => $faker->email(), 'address' => 'Test loaction21', 'password' => 'secret'];

        $this->json('post', "/owners", $parameters, $headers);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                'name',
                'email',
                'address',
                'created_at',
                'updated_at',
            ]]
        );

    }

    /**
     * /owners/id [PUT]
     */
    public function testShouldUpdateOwner()
    {
        $faker = Faker\Factory::create();

        $response = $this->loginApi();
        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $parameters = ['name' => $faker->name(), 'address' => $faker->address()];

        $this->json("PUT", "owners/4", $parameters, $headers);
        // $this->seeStatusCode(200);

        $this->seeJsonStructure(
            ['data' =>
                [
                'name',
                'email',
                'address',
                'created_at',
                'updated_at',
            ]]
        );

    }

    /**
     * /owners/id [DELETE]
     */
    public function testShouldDeleteOwner()
    {
        $faker = Faker\Factory::create();

        $response = $this->loginApi();
        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $parameters = ['name' => 'test owner', 'email' => $faker->email(), 'address' => 'Test loaction21', 'password' => 'secret'];

        $owner = $this->json('post', "/owners", $parameters, $headers);
        $owner = json_decode($this->response->getContent());

        $this->json("delete", "/owners/{$owner->data->id}", [], $headers);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                'name',
                'email',
                'address',
                'created_at',
                'updated_at',
            ]]
        );


    }

    // login function
    function loginApi()
    {
        $parameters = [
            "grant_type" => "client_credentials",
            "client_id" => 2,
            "client_secret" => "rH9H2Cdtfzke4qxW0M4ow6UgLBkUgl3uMQw5EWZm",
            "scope" => "*"
        ];

        $response = $this->post("/oauth/token", $parameters, ['Accept' => 'application/json']);

        return $response;
    }
}