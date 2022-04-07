<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{

    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

                'rolename' => $this->faker->randomElement(['admin', 'user' ,'manager','srmanager','generalmanager']),
                'user_id' => mt_rand(1,10)
        ];
    }
}
