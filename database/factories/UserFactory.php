<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'department' => $this->faker->sentence(3),
            'department_code' => $this->faker->sentence(3),
            'suppervisor' => $this->faker->name(),
            'suppervisor_posname' => $this->faker->name(),
            'suppervisor_id' => mt_rand(1,10),
            'status' => $this->faker->randomElement(['active', 'nonactive']),
            'posname' => $this->faker->jobTitle(),
            'poscode' => $this->faker->jobTitle(),
            'posstatus' => $this->faker->jobTitle(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'expiredcontractdate' => Carbon::now(),
            'sex' => $this->faker->randomElement(['male', 'female']),
            'birthdate' => Carbon::createFromDate($this->faker->numberBetween(1980, 2000), $this->faker->numberBetween(1, 12), $this->faker->numberBetween(1, 31), 'Asia/Jakarta'),
            'religion' => $this->faker->randomElement(['muslim', 'kristen','protestan','budha','kaleng']),
            'spouse' => $this->faker->name(),
            'child1'=> $this->faker->name(),
            'child2' => $this->faker->name(),
            'child3' => $this->faker->name(),
            'married' => $this->faker->numberBetween(0, 1),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'phonenum' => $this->faker->phoneNumber(),
            'bankkey' => $this->faker->creditCardNumber(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
