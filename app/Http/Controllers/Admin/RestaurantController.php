<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class RestaurantController extends Controller
{
    public function index(): Response
    {
        Gate::authorize('restaurant.viewAny', Restaurant::class);

        return Inertia::render('Admin/Restaurants/Index', [
            'restaurants' => Restaurant::query()->with('city', 'owner')->get(),
        ]);
    }

    public function create(): Response
    {
        Gate::authorize('restaurant.create', Restaurant::class);

        return Inertia::render('Admin/Restaurants/Create', [
            'cities' => City::query()->get(['id', 'name']),
        ]);
    }
}
