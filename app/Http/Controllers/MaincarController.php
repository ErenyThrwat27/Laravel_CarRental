<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Models\Testimonial;

class MaincarController extends Controller
{
    public function home(){          //home page (show 6 cars and 3 testimonials)

        $cars = Car::latest()->take(6)->get();
        $testimonials = Testimonial::latest()->take(3)->get();
        $category = Category::get();
       return view('index',compact('cars','testimonials','category'));

   }

    public function listing(){          //listing page

         $cars = Car::get();
         $testimonials = Testimonial::latest()->take(3)->get();
        return view('listing',compact('cars','testimonials'));

    }

    public function show(string $id)
     {  $testimonials = Testimonial::get();
        $cars = Car::where('id', $id)->firstOrFail(); // Find the car by its ID
        return view('single', compact('cars','testimonials'));
        
    }

    public function category_cars(){          //relation one to many(Category & Cars)
        $categories = Category::withCount('cars')->get();
    return view('categories.index', compact('categories'));
    }
    public function car_category(){                 //inverse relation 
        $car_category=Car::find(1)->category;
        echo $car_category->category_name;
    }
}
