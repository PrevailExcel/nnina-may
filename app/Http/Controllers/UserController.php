<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /** 
         * Gets all the parameters, loops over them
         * Checks if they are actual attributes of the model,
         * Makes sure they have a value
         * Builds the eloquent query and returns the data as a collection.
         */
        $getParamenters = (array) $request->all();
        foreach ($getParamenters as $key => $value) {
            $checkKey = Schema::hasColumn('users', $key);
            if (!$checkKey || !$value) {
                unset($getParamenters[$key]);
            }
        }
        $users = User::where($getParamenters)->get();
        return $users;
    }
}
