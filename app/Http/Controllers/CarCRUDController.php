<?php

namespace App\Http\Controllers;
use Log;
use App\Models\Car;
use Illuminate\Http\Request;

class CarCRUDController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    $data['cars'] = Car::orderBy('id','desc')->paginate(5);
    return view('cars.index', $data);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
    return view('cars.create');
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {Log::info('Showing user profile for user: ');
    $request->validate([
    'name' => 'required',
    'color' => 'required',
    'model' => 'required'
    ]);
    $car = new Car;
    $car->name = $request->name;
    $car->color = $request->color;
    $car->model = $request->model;
    $car->save();
    return redirect()->route('cars.index')
    ->with('success','car has been created successfully.');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\car  $car
    * @return \Illuminate\Http\Response
    */
    public function show(car $car)
    {
    return view('cars.show',compact('car'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\car  $car
    * @return \Illuminate\Http\Response
    */
    public function edit(car $car)
    {
    return view('cars.edit',compact('car'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\car  $car
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
    $request->validate([
    'name' => 'required',
    'color' => 'required',
    'model' => 'required',
    ]);
    $car = car::find($id);
    $car->name = $request->name;
    $car->color = $request->color;
    $car->model = $request->model;
    $car->save();
    return redirect()->route('cars.index')
    ->with('success','car Has Been updated successfully');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\car  $car
    * @return \Illuminate\Http\Response
    */
    public function destroy(car $car)
    {
    $car->delete();
    return redirect()->route('cars.index')
    ->with('success','car has been deleted successfully');
    }
    }