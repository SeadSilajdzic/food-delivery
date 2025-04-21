<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cities in Bosnia and Herzegovina
        $cities = [
            'Banja Luka', 'Sarajevo', 'Tuzla', 'Zenica', 'Mostar', 'Bihać', 'Doboj', 'Prijedor',
            'Bijeljina', 'Trebinje', 'Brčko', 'Zvornik', 'Cazin', 'Goražde', 'Visoko', 'Gradačac',
            'Gračanica', 'Sanski Most', 'Kakanj', 'Lukavac', 'Srebrenik', 'Zavidovići', 'Travnik',
            'Bugojno', 'Konjic', 'Tešanj', 'Čapljina', 'Mrkonjić Grad', 'Bosanska Krupa',
            'Bosanski Novi', 'Široki Brijeg', 'Posušje', 'Livno', 'Jajce', 'Foča', 'Modriča',
            'Vitez', 'Čitluk', 'Kiseljak', 'Prozor-Rama', 'Gornji Vakuf-Uskoplje', 'Neum',
            'Odžak', 'Bosanski Petrovac', 'Kladanj', 'Maglaj', 'Olovo', 'Kotor Varoš',
            'Kupres', 'Rogatica', 'Lopare', 'Zvornik', 'Ugljevik', 'Kalesija', 'Other'
        ];

        foreach($cities as $city) {
            City::query()->create(['name' => $city]);
        }
    }
}
