<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->query()) {
            foreach ($request->query() as $key => $value) {
                if ($key == 'page') {
                    continue;
                } elseif ($key == 's') {
                    $query->where('name', 'like', "%{$value}%");
                } else {
                    $query->where($key, $value);
                }
            }
        }
        
        return $query->orderBy('created_at', 'desc')->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $record = User::create($data);

            if ($record) {
                $response = array(
                    'status'  => 'success',
                    'message' => 'Record created successfully',
                    'record'  => $record,
                );
            } else {
                $response = array(
                    'status'  => 'success',
                    'message' => 'Could not create record',
                );
            }

        } catch (\Throwable $th) {
            $response = array(
                'status'  => 'error',
                'message' => $th->getMessage(),
            );
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        try {
            $record = $user->update($data);

            if ($record) {
                $response = array(
                    'status'  => 'success',
                    'message' => 'Record updated successfully',
                    'record'  => $record,
                );
            } else {
                $response = array(
                    'status'  => 'success',
                    'message' => 'Could not update record',
                );
            }

        } catch (\Throwable $th) {
            $response = array(
                'status'  => 'error',
                'message' => $th->getMessage(),
            );
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $record = $user->delete();

            if ($record) {
                $response = array(
                    'status'  => 'success',
                    'message' => 'Record deleted successfully',
                    'record'  => $record,
                );
            } else {
                $response = array(
                    'status'  => 'success',
                    'message' => 'Could not delete record',
                );
            }

        } catch (\Throwable $th) {
            $response = array(
                'status'  => 'error',
                'message' => $th->getMessage(),
            );
        }

        return $response;
    }
}
