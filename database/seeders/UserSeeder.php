<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUser();
        $this->createVendorUser();
    }

    public function createAdminUser(): void
    {
        User::query()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ])->roles()->sync(Role::query()->where('name', RoleName::ADMIN->value)->first());
    }

    public function createVendorUser(): void
    {
        $vendor = User::query()->create([
            'name' => 'Restaurant owner',
            'email' => 'vendor@vendor.com',
            'password' => bcrypt('password'),
        ]);

        $vendor->roles()->sync(Role::query()->where('name', RoleName::VENDOR->value)->first());

        $vendor->restaurant()->create([
            'city_id' => City::query()->first()->id,
            'name' => 'Restaurant 001',
            'address' => 'Address FSTC001',
        ]);
    }
}
