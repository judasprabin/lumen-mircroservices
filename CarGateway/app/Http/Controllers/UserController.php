<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use ApiResponser;

    /**
     * Create a new user instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * return all the users registered 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return $this->validResponse($users);
    }

    /**
     * create a new user
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->validResponse($user, Response::HTTP_CREATED);

    }

    /**
     * obtain and return one user
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return $this->validResponse($user);

    }

    /**
     * update and show a user
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'max:255',
            'email' => 'email|unique:users,email' . $id,
            'password' => 'min:8|confirmed'
        ];

        $this->validate($request, $rules);

        $user = User::findOrFail($id);

        $user->fill($request->all());

        // if password is provided encrypt it
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        // check if value changed
        if ($user->isClean()) {
            return $this->errorResponse("Noting to update", Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->validResponse($user);
    }

    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $this->validResponse($user);

    }

    /**
     * Identify an existing user
     * @return Illuminate\Http\Response
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return $this->validResponse($user);

    }

}
