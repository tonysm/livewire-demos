<?php

namespace App\Services\Stores;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Collection;

class Repository
{
    public function searchByZip(string $zip): Collection
    {
        sleep(3);

        return $this->all()
            ->filter(fn (array $store) => $store['zip'] === $zip);
    }

    private function all()
    {
        $faker = Factory::create();

        return collect([
            $this->fake($faker, '50210'),
            $this->fake($faker, '50210'),
            $this->fake($faker, '50210'),
            $this->fake($faker, '80302'),
            $this->fake($faker, '80302'),
        ]);
    }

    private function fake(Generator $faker, string $zip): array
    {
        return [
            'name' => $faker->company,
            'address' => $faker->address,
            'zip' => $zip,
        ];
    }
}
