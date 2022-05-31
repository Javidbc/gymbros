<?php

namespace App\Factory;

use App\Entity\Usuario;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Usuario>
 *
 * @method static Usuario|Proxy createOne(array $attributes = [])
 * @method static Usuario[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Usuario|Proxy find(object|array|mixed $criteria)
 * @method static Usuario|Proxy findOrCreate(array $attributes)
 * @method static Usuario|Proxy first(string $sortedField = 'id')
 * @method static Usuario|Proxy last(string $sortedField = 'id')
 * @method static Usuario|Proxy random(array $attributes = [])
 * @method static Usuario|Proxy randomOrCreate(array $attributes = [])
 * @method static Usuario[]|Proxy[] all()
 * @method static Usuario[]|Proxy[] findBy(array $attributes)
 * @method static Usuario[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Usuario[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method Usuario|Proxy create(array|callable $attributes = [])
 */
final class UsuarioFactory extends ModelFactory
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
            'dni' => self::faker()->unique()->dni(),
            'nombre' => self::faker()->firstName(),
            'apellidos' => self::faker()->lastName() . ' ' . self::faker()->lastName(),
            'telefono' => self::faker()->phoneNumber(),
            'fechaNacimiento' => self::faker()->dateTime(), // TODO add DATETIME ORM type manually
            'correo' => self::faker()->unique()->email(),
            'contrasenia' => self::faker()->password(),
            'foto' => self::faker()->imageUrl(),
            'activado' => self::faker()->boolean(),
            'esAdmin' => self::faker()->boolean(),
            'esMonitor' => self::faker()->boolean(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Usuario $usuario): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Usuario::class;
    }
}
