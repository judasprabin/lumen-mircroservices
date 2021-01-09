<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;


class CarService
{
    use ConsumeExternalService;

    /**
     * Base uri to consume authors service
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
        $this->baseUri = config('services.cars.base_uri');
        $this->secret = config('services.cars.secret');
    }

    /**
     * obtain list of cars
     * @return string
     */
    public function obtainCars()
    {
        return $this->performRequest('GET', '/cars');
    }

    /**
     * obtain specific car
     * @return string
     */
    public function obtainCar($id)
    {
        return $this->performRequest('GET', "/cars/{$id}");
    }

    /**
     * create new car
     * @return string
     */
    public function createCar($data)
    {
        return $this->performRequest('POST', '/cars', $data);
    }

    /**
     * Update car using owner service
     * @return string
     */
    public function updateCar($data, $id)
    {
        return $this->performRequest('PUT', "/cars/{$id}", $data);
    }

    /**
     * Delete Owner
     * @return string
     */
    public function deleteCar($id)
    {
        return $this->performRequest('DELETE', "/cars/{$id}");
    }




}
