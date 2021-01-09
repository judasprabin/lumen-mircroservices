<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Models\Car;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CarController extends Controller
{

    use ApiResponser;

    /**
     * Create a new car instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * return all the cars registered 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();

        return $this->successResponse($cars);
    }

    /**
     * create a new car
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'make' => 'required|max:255|in:Toyota,BMW,Mercedez',
            'model' => 'required|max:255',
            'year' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'current_value' => 'required|numeric',
            'owner_id' => 'nullable|numeric'
        ];

        $this->validate($request, $rules);

        $car = Car::create($request->all());

        return $this->successResponse($car, Response::HTTP_CREATED);

    }

    /**
     * obtain and return one car
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);

        return $this->successResponse($car);

    }

    /**
     * update and show a car
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'make' => 'max:255|in:Toyota,BMW,Mercedez',
            'model' => 'max:255',
            'year' => 'numeric',
            'owner_id' => 'nullable|numeric'
        ];

        $this->validate($request, $rules);

        $car = Car::findOrFail($id);

        $car->fill($request->all());

        // check if value changed
        if ($car->isClean()) {
            return $this->errorResponse("Noting to update", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $car->save();

        return $this->successResponse($car);
    }

    /**
     * Remove an existing car
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $car = Car::findOrFail($id);

        $car->delete();

        return $this->successResponse($car);

    }
}
