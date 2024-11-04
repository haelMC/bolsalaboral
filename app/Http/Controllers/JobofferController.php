<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Joboffer;
use Illuminate\Http\Request;

class JobofferController extends Controller
{
    public function index()
    {
        $joboffers = Joboffer::all();
        return view('joboffers.index', compact('joboffers'));
    }

    public function show(Joboffer $joboffer)
    {
        $ultimas = Joboffer::latest('id')->take(6)->get();
        $categories = Category::all();
        return view('joboffers.show', compact('joboffer', 'ultimas', 'categories'));
    }

    public function search(Category $category)
    {
        $joboffers = Joboffer::where('category_id', $category->id)->get();
        $categories = Category::all();
        return view('joboffers.search', compact('joboffers', 'categories'));
    }
}
