<?php

namespace Database\Factories;

use App\Models\MailAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MailAccountFactory extends Factory
{
    protected $model = MailAccount::class;

    public function definition(): array
    {
        return [
            'username' => $this->faker->userName(),
            'password' => bcrypt($this->faker->password()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
