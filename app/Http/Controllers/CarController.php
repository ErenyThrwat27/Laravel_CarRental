<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Models\Testimonial;

class CarController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }


   
    /**
     * Display a listing of the resource.
     */
    public function index()              //show all cars 
    {
        $cars=Car::get();
        return view('admin.cars',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::get();
        return view('admin.addCar',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cars=new Car();
        $cars->title=$request->title;
        $cars->content=$request->content;
        $cars->luggage=$request->luggage;
        $cars->doors=$request->doors;
        $cars->passengers=$request->passengers;
        $cars->price=$request->price;
        $cars->image=$request->image;
        $cars->category_id=$request->category_id;
        $cars->save();
        return redirect('/admin/cars');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
     {  
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::get();
        $cars= Car::find($id);
        return view('admin.editCar',compact('cars','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cars= Car::find($id);
        $cars->title=$request->title;
        $cars->content=$request->content;
        $cars->luggage=$request->luggage;
        $cars->doors=$request->doors;
        $cars->passengers=$request->passengers;
        $cars->price=$request->price;
        $cars->image=$request->image;
        $cars->category_id=$request->category_id;
        $cars->save();
        return redirect('/admin/cars');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cars=Car::find($id)->delete();
        return redirect('admin/cars');

    }
    public function showDeleted(){
        $cars=Car::onlyTrashed()->get();
        return view('admin.cartrashed',compact('cars'));
     }


     public function restore(Request $request){
        $id=$request->id;
        Car::where('id',$id)->restore();
        return redirect('/admin/cars');
     }
}
