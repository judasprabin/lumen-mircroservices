<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;


class OwnerService
{
    use ConsumeExternalService;

    /**
     * base uri to consume authors service
     * $var string
     */
    public $baseUri;

    /**
     * Secret to consume authors service
     * $var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.owners.base_uri');
        $this->secret = config('services.owners.secret');
    }

    /**
     * obtain list of owners
     * @return string
     */
    public function obtainOwners()
    {
        return $this->performRequest('GET', '/owners');
    }

    /**
     * obtain specific owner
     * @return string
     */
    public function obtainOwner($id)
    {
        return $this->performRequest('GET', "/owners/{$id}");
    }

    /**
     * create new owner
     * @return string
     */
    public function createOwner($data)
    {
        return $this->performRequest('POST', '/owners', $data);
    }

    /**
     * Update owner using owner service
     * @return string
     */
    public function updateOwner($data, $id)
    {
        return $this->performRequest('PUT', "/owners/{$id}", $data);
    }

    /**
     * Delete Owner
     * @return string
     */
    public function deleteOwner($id)
    {
        return $this->performRequest('DELETE', "/owners/{$id}");
    }


}
