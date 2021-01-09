<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Services\CarService;
use App\Services\OwnerService;

class CarController extends Controller
{

    use ApiResponser;

    /**
     * The service to consume Cars microservice
     * @var CarSevice
     */
    public $carService;

    /**
     * The service to consume Owners microservice
     * @var OwnerSevice
     */
    public $ownerService;

    /**
     * Create a new Car instance.
     *
     * @return void
     */
    public function __construct(CarService $carService, OwnerService $ownerService)
    {
        $this->carService = $carService;
        $this->ownerService = $ownerService;
    }

    /**
     * return all the Cars registered 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $Cars = $this->carService->obtainCars();

        return $this->successResponse($Cars);
    }

    /**
     * create a new Car
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ownerService->obtainOwner($request->owner_id);

        $Car = $this->carService->createCar($request->all(), Response::HTTP_CREATED);

        return $this->successResponse($Car);

    }

    /**
     * obtain and return one Car
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $Cars = $this->carService->obtainCar($id);

        return $this->successResponse($Cars);

    }

    /**
     * update and show a Car
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $this->ownerService->obtainOwner($request->owner_id);

        $Car = $this->carService->updateCar($request->all(), $id);

        return $this->successResponse($Car);
    }

    /**
     * Remove an existing Car
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $Car = $this->carService->deleteCar($id);

        return $this->successResponse($Car);

    }
}
