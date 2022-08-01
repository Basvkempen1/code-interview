<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierImport>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'naam'                      => $this->faker->company(),
            'email'                     => $this->faker->email(),
            'email_marketing'           => $this->faker->email(),
            'telefoon'                  => $this->faker->phoneNumber(),
            'assorti_order'             => $this->faker->boolean(),
            'prijscontrole'             => $this->faker->boolean(),
            'marketingbijdrage'         => $this->faker->randomFloat(2,0, 1000),
            'franco'                    => $this->faker->numberBetween(0, 1500),
            'twm_actief'                => $this->faker->boolean(90),
            'twm_calculatie'            => $this->faker->randomFloat(2, 1, 2),
            'straat'                    => $this->faker->streetName(),
            'huisnummer'                => $this->faker->numberBetween(0, 999),
            'plaats'                    => $this->faker->city(),
            'land'                      => $this->faker->countryCode(),
            'correspondentie_taal'      => 'EN',
            'voorkeur_groep'            => $this->faker->numberBetween(0, 12),
            'leverancier_actief'        => $this->faker->boolean(90),
            'garantieafwikkeling'       => $this->faker->text(50),
            'garantie_afgekocht'        => $this->faker->boolean(),
            'inkoopconditie'            => '',
            'productinfobronnen'        => '',
            'aanmelden_levering'        => '',
            'periodieke_prijscontrole'  => 3,
            'dooslevering'              => $this->faker->boolean(30),


        ];
    }
}
