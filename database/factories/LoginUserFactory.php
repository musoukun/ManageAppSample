<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Providers\RouteServiceProvider;
use App\Models\LoginUser;
use App\Common\Trait\ObjectTrait;
use App\Common\Trait\StringTrait;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoginUser>
 */
class LoginUserFactory extends Factory
{

    use StringTrait;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoginUser::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'displayName' => fake()->unique()->name(),
            'loginUserId' => fake()->id(),
            'staffCode' => fake()->randomNumber(4),
            'password' => fake()->password(),
        ];
    }
}
