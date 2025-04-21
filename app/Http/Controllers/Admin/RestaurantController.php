<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRestaurantRequest;
use App\Http\Requests\Admin\UpdateRestaurantRequest;
use App\Models\City;
use App\Models\Restaurant;
use App\Models\Role;
use App\Models\User;
use App\Notifications\RestaurantOwnerInvitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
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

    public function store(StoreRestaurantRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $user = User::query()->create([
                'name' => $validated['owner_name'],
                'email' => $validated['email'],
                'password' => '',
            ]);

            $user->roles()->sync(Role::query()->where('name', RoleName::VENDOR->value)->first());

            $user->restaurant()->create([
                'city_id' => $validated['city_id'],
                'name' => $validated['restaurant_name'],
                'address' => $validated['address'],
            ]);

            $user->notify(new RestaurantOwnerInvitation($validated['restaurant_name']));
        });

        return to_route('admin.restaurants.index');
    }

    public function edit(Restaurant $restaurant): Response
    {
        Gate::authorize('restaurant.update', Restaurant::class);

        $restaurant->load('city', 'owner');

        return Inertia::render('Admin/Restaurants/Edit', [
            'restaurant' => $restaurant,
            'cities' => City::query()->get(['id', 'name']),
        ]);
    }

    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): RedirectResponse
    {
        $validated = $request->validated();

        $restaurant->update([
            'city_id' => $validated['city'],
            'name'    => $validated['restaurant_name'],
            'address' => $validated['address'],
        ]);

        return to_route('admin.restaurants.index')
            ->withStatus('Restaurant updated successfully.');
    }
}
