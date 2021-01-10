
<?php
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class OwnerTest extends TestCase
{
    use DatabaseTransactions;


    public function testLogin()
    {

        $parameters = [
            "grant_type" => "client_credentials",
            "client_id" => 2,
            "client_secret" => "rH9H2Cdtfzke4qxW0M4ow6UgLBkUgl3uMQw5EWZm",
            "scope" => "*"
        ];

        $response = $this->post("/oauth/token", $parameters, ['Accept' => 'application/json']);

        $token = json_decode($this->response->getContent(), true);

        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer ' . $token['access_token'];

        // $this->assertStatus(200);
        $this->seeJson(["access_token"]);


    }
    /**
     * /Owners [GET]
     */
    public function testShouldReturnAllOwners()
    {

        $parameters = [
            "grant_type" => "client_credentials",
            "client_id" => 2,
            "client_secret" => "rH9H2Cdtfzke4qxW0M4ow6UgLBkUgl3uMQw5EWZm",
            "scope" => "*"
        ];

        $response = $this->post("/oauth/token", $parameters, ['Accept' => 'application/json']);

        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $this->get("/owners", [], $headers);
        // $this->seeStatusCode(200);
        $this->seeJson([
            'name',
            'email',
            'address',
            'created_at',
            'updated_at',
        ]);

    }

    /**
     * /owners/id [GET]
     */
    public function testShouldReturnOwner()
    {
        $parameters = [
            "grant_type" => "client_credentials",
            "client_id" => 2,
            "client_secret" => "rH9H2Cdtfzke4qxW0M4ow6UgLBkUgl3uMQw5EWZm",
            "scope" => "*"
        ];

        $response = $this->post("/oauth/token", $parameters, ['Accept' => 'application/json']);

        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $this->get("/owners/2", $headers);
        // $this->seeStatusCode(200);
        $this->seeJson([
            'name',
            'email',
            'address',
            'created_at',
            'updated_at',
        ]);

    }

    /**
     * /Owners [POST]
     */
    public function testShouldCreateOwner()
    {

        $parameters = [
            "grant_type" => "client_credentials",
            "client_id" => 2,
            "client_secret" => "rH9H2Cdtfzke4qxW0M4ow6UgLBkUgl3uMQw5EWZm",
            "scope" => "*"
        ];

        $response = $this->post("/oauth/token", $parameters, ['Accept' => 'application/json']);

        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $parameters = ['name' => 'test owner', 'email' => 'newemail@gmail.com', 'address' => 'Test loaction21', 'password' => 'secret'];

        $this->json('post', "/owners", $parameters, $headers);
        // $this->seeStatusCode(200);
        $this->seeJson([
            'name',
            'email',
        ]);

    }

    /**
     * /owners/id [PUT]
     */
    public function testShouldUpdateOwner()
    {
        $parameters = [
            "grant_type" => "client_credentials",
            "client_id" => 2,
            "client_secret" => "rH9H2Cdtfzke4qxW0M4ow6UgLBkUgl3uMQw5EWZm",
            "scope" => "*"
        ];

        $response = $this->post("/oauth/token", $parameters, ['Accept' => 'application/json']);

        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];

        $parameters = ['name' => 'test owner', 'email' => 'newemail11@gmail.com', 'address' => 'Test loaction21', 'password' => 'secret'];

        $this->json("PUT", "owners/4", $parameters, $headers);
        // $this->seeStatusCode(200);
        $this->seeJson([
            'name',
            'email'
        ]);

    }

    /**
     * /owners/id [DELETE]
     */
    public function testShouldDeleteProduct()
    {
        $parameters = [
            "grant_type" => "client_credentials",
            "client_id" => 2,
            "client_secret" => "rH9H2Cdtfzke4qxW0M4ow6UgLBkUgl3uMQw5EWZm",
            "scope" => "*"
        ];

        $response = $this->post("/oauth/token", $parameters, ['Accept' => 'application/json']);

        $token = json_decode($this->response->getContent(), true);

        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token['access_token'];


        $this->json("delete", "/owners/2", [], $headers);
        // $this->seeStatusCode(410);
        $this->seeJson([
            'name',
            'email'
        ]);

    }

}