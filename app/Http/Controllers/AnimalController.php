<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        $animalsQuery = Animal::query();

        $perPage = $request->get('per_page') ?? 10;

        if($request->get('family_id')){
            $animalsQuery = $animalsQuery->where('family_id', $request->get('family_id'));
        }

        if($request->get('evolution_stage')){
            $animalsQuery = $animalsQuery->where('evolution_stage', $request->get('evolution_stage'));
        }

        if($request->get('evolved')){
            $animalsQuery = $animalsQuery->where('evolved', $request->get('evolved'));
        }

        if($request->get('cross_gen')){
            $animalsQuery = $animalsQuery->where('cross_gen', $request->get('cross_gen'));
        }

        if($request->get('type_1')){
            $animalsQuery = $animalsQuery->where('type_1', $request->get('type_1'));
        }

        if($request->get('type_2')){
            $animalsQuery = $animalsQuery->where('type_2', $request->get('type_2'));
        }

        if($request->get('weather_1')){
            $animalsQuery = $animalsQuery->where('weather_1', $request->get('weather_1'));
        }

        if($request->get('weather_2')){
            $animalsQuery = $animalsQuery->where('weather_2', $request->get('weather_2'));
        }

        return $animalsQuery->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $animalFields = $request->json();

        $inserted = Animal::query()->insert([$animalFields->all()]);

        if($inserted){
            return response()->json([
                'success' => true,
                'msg' => 'animal inserted successfully'
            ], 201);
        }

        return response([
            'success' => 0,
            'msg' => 'something is wrong'
        ], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal){
        return $animal->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal){
        $postFields = $request->all();

        try{
            $animal->updateOrFail($postFields);

            return response([
                'success' => 1,
                'msg' => 'updated successfully'
            ], 201);
        }catch (\Throwable $e) {
            return response([
                'success' => 0,
                'msg' => 'something is wrong'
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal){
        if($animal->delete()){
            return response([
                'success' => 1,
                'msg' => 'deleted successfully'
            ], 201);
        }

        return response([
            'success' => 0,
            'msg' => 'wrong animal id provided'
        ], 401);
    }
}
