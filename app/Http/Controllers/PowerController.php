<?php

namespace App\Http\Controllers;

use App\Models\Power;
use Illuminate\Http\Request;

class PowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Power::query();

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
        
        return $query->paginate(3);
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
            $record = Power::create($data);

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
     * @param  \App\Models\Power  $power
     * @return \Illuminate\Http\Response
     */
    public function show(Power $power)
    {
        return $power;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Power  $power
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Power $power)
    {
        $data = $request->all();

        try {
            $record = $power->update($data);

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
     * @param  \App\Models\Power  $power
     * @return \Illuminate\Http\Response
     */
    public function destroy(Power $power)
    {
        try {
            $record = $power->delete();

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
