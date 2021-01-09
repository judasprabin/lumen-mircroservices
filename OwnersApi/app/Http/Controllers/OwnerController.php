<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Models\Owner;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OwnerController extends Controller
{

    use ApiResponser;

    /**
     * Create a new Owner instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * return all the Owners registered 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $owners = Owner::all();

        return $this->successResponse($owners);
    }

    /**
     * create a new Owner
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|unique:owners|Email',
            'address' => 'nullable|max:255',
            'password' => 'nullable',
        ];

        $this->validate($request, $rules);

        $owner = Owner::create($request->all());

        return $this->successResponse($owner, Response::HTTP_CREATED);

    }

    /**
     * obtain and return one Owner
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $owner = Owner::findOrFail($id);

        return $this->successResponse($owner);

    }

    /**
     * update and show a Owner
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('owners')->ignore($id),
            ],
            'address' => 'nullable|max:255',
            'password' => 'nullable',
        ];

        $this->validate($request, $rules);

        $owner = Owner::findOrFail($id);

        $owner->fill($request->all());

        // check if value changed
        if ($owner->isClean()) {
            return $this->errorResponse("Noting to update", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $owner->save();

        return $this->successResponse($owner);
    }

    /**
     * Remove an existing Owner
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $owner = Owner::findOrFail($id);

        $owner->delete();

        return $this->successResponse($owner);

    }
}
