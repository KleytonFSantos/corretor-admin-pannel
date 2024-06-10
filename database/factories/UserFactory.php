<?php

namespace Database\Factories;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cpf' => $this->cpfExists('12345678911') ? $this->generateCpf() : '12345678911',
            'email_verified_at' => now(),
            'roles_id' => RolesEnum::SUPER_ADMIN,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    private function generateCpf(): string
    {
        $cpf = '';
        for ($i = 0; $i < 11; $i++) {
            $cpf.= rand(0, 9);
        }
        return $cpf;
    }

    public function cpfExists(string $cpf): bool
    {
        return User::where('cpf', $cpf)->exists();
    }
}
