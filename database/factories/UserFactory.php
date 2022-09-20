<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\AdminModel;
use App\Models\RolesModel;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'admin_email' => $faker->unique()->safeEmail,
            'admin_password' => md5('123456'),
            'admin_name' => $faker->name,
            'admin_slug' => 'doan-van-khai-faker',
            'admin_birdthday' => '01-10-2001',
            'admin_address' => '748 Hùng Vương, thị trấn Chư Sê, huyện Chư Sê, tỉnh Gia Lai',
            'admin_image' => 'khaiii891296.png',
            'admin_phone' => '0378726127',
            'admin_status' => '0',
            'waste_basket_admin' => '0',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
$factory->define(AdminModel::class,function(Faker $faker){
    return [
        'admin_email' => $faker->unique()->safeEmail,
        'admin_password' => md5('123456'),
        'admin_name' => $faker->name,
        'admin_slug' => 'doan-van-khai-faker',
        'admin_birdthday' => '01-10-2001',
        'admin_address' => '748 Hùng Vương, thị trấn Chư Sê, huyện Chư Sê, tỉnh Gia Lai',
        'admin_image' => 'khaiii891296.png',
        'admin_phone' => '0378726127',
        'admin_status' => '0',
        'waste_basket_admin' => '0',
    ];
});
$factory->afterCreating(AdminModel::class,function($admin,$faker){
    $roles = RolesModel::where('roles_name','user')->get();
    $admin->roles()->sync($roles->pluck('roles_id')->toArray());
});