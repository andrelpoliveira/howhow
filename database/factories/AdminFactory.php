<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>'Banhammer',
            'email' => 'hammer@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('adminadmin'), // password
            'remember_token' => Str::random(10),
            'phone' => 'everyone',
            'office' => 'qualquercoisa',
            'layout' => 'outracoisa',
            'language' => 'maisumacoisa',
        ];
    }

}
