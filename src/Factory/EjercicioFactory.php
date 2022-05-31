<?php

namespace App\Factory;

use App\Entity\Ejercicio;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Ejercicio>
 *
 * @method static Ejercicio|Proxy createOne(array $attributes = [])
 * @method static Ejercicio[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Ejercicio|Proxy find(object|array|mixed $criteria)
 * @method static Ejercicio|Proxy findOrCreate(array $attributes)
 * @method static Ejercicio|Proxy first(string $sortedField = 'id')
 * @method static Ejercicio|Proxy last(string $sortedField = 'id')
 * @method static Ejercicio|Proxy random(array $attributes = [])
 * @method static Ejercicio|Proxy randomOrCreate(array $attributes = [])
 * @method static Ejercicio[]|Proxy[] all()
 * @method static Ejercicio[]|Proxy[] findBy(array $attributes)
 * @method static Ejercicio[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Ejercicio[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Ejercicio|Proxy create(array|callable $attributes = [])
 */
final class EjercicioFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'nombre' => self::faker()->name(),
            'grupoMuscular' => self::faker()->colorName(),
            'descripcion' => self::faker()->text(),
            'url' => 'https://www.youtube.com/embed/7aQY3u0Dk-Q'
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Ejercicio $ejercicio): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Ejercicio::class;
    }
}
