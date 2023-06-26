<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Providers\RouteServiceProvider;
use App\Models\Employee;
use App\Common\Trait\ObjectTrait;
use App\Common\Trait\StringTrait;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{

    use StringTrait;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstname = fake()->firstName();
        $lastname = fake()->lastname();
        $firstnameKana = $this->kanji2Hira($firstname);
        $lastnameKana = $this->kanji2Hira($lastname);

        return [
            'staffCode' => fake()->randomNumber(),
            'staffFirstName' => $firstname,
            'staffLastName' => $lastname,
            'staffFirstNameKana' => $firstnameKana,
            'staffLastNameKana' => $lastnameKana,
            'sex' => fake()->randomElement(['1', '2']),
            'departmentCode' => fake()->randomNumber(5),
            'unitCode' => fake()->randomNumber(4),
            'travelCost' => fake()->randomNumber(5),
            'birthdate' => fake()->date('Ymd'),
            'postcode' => fake()->postcode(),
            'address' => fake()->address(),
            'tel' => fake()->phoneNumber(),
            'mail' => fake()->freeEmailDomain('example.com'),
            'remark' => fake()->realText(50)
        ];
    }
}
