<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Models\Owner;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\OwnerService;

class OwnerController extends Controller
{

    use ApiResponser;

    /**
     * The service to consume Owners microservice
     * @var OwnerSevice
     */

    public $ownerService;

    /**
     * Create a new Owner instance.
     *
     * @return void
     */

    public function __construct(OwnerService $ownerService)
    {
        $this->ownerService = $ownerService;
    }

    /**
     * return all the Owners registered 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $owners = $this->ownerService->obtainOwners();

        return $this->successResponse($owners);
    }

    /**
     * create a new Owner
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $owner = $this->ownerService->createOwner($request->all(), Response::HTTP_CREATED);

        return $this->successResponse($owner);

    }

    /**
     * obtain and return one Owner
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $owners = $this->ownerService->obtainOwner($id);

        return $this->successResponse($owners);

    }

    /**
     * update and show a Owner
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $owner = $this->ownerService->updateOwner($request->all(), $id);

        return $this->successResponse($owner);
    }

    /**
     * Remove an existing Owner
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $owner = $this->ownerService->deleteOwner($id);

        return $this->successResponse($owner);

    }
}
