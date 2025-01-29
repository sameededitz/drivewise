<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function cars()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $cars = $user->cars()->get();
        return response()->json([
            'status' => true,
            'message' => 'Cars fetched successfully!',
            'cars' => $cars
        ]);
    }

    public function addCar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'model' => 'required|string|max:255|min:3',
            'model_year' => 'required|integer|digits:4',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20420',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $car = $user->cars()->create([
            'name' => $request->name,
            'model' => $request->model,
            'model_year' => $request->model_year
        ]);

        if ($request->hasFile('image')) {
            $car->addMedia($request->image->getRealPath())
                ->usingFileName($request->image->getClientOriginalName())
                ->toMediaCollection('image');
        }

        return response()->json([
            'status' => true,
            'message' => 'Car added successfully!',
            'car' => $car
        ]);
    }

    public function show(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Car fetched successfully!',
            'car' => $car
        ]);
    }

    public function update(Request $request, Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }    

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'model' => 'required|string|max:255|min:3',
            'model_year' => 'required|integer|digits:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20420',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $car->update([
            'name' => $request->name,
            'model' => $request->model,
            'model_year' => $request->model_year
        ]);

        if ($request->hasFile('image')) {
            $car->clearMediaCollection('image');
            $car->addMedia($request->image->getRealPath())
                ->usingFileName($request->image->getClientOriginalName())
                ->toMediaCollection('image');
        }

        return response()->json([
            'status' => true,
            'message' => 'Car updated successfully!',
            'car' => $car
        ]);
    }

    public function delete(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }
        $car->clearMediaCollection('image');
        $car->delete();
        return response()->json([
            'status' => true,
            'message' => 'Car deleted successfully!'
        ]);
    }
}
