<?php

declare(strict_types=1);

namespace Bag\Concerns;

use Bag\Exceptions\InvalidBag;
use Bag\Property\Value;
use Bag\Property\ValueCollection;
use ReflectionClass;
use ReflectionParameter;

trait WithProperties
{
    protected static function getProperties(ReflectionClass $class): ValueCollection
    {
        static $cache = [];
        $key = static::class;
        if (isset($cache[$key])) {
            return $cache[$key];
        }

        /** @var ValueCollection $properties */
        $properties = ValueCollection::make($class->getConstructor()?->getParameters())->mapWithKeys(function (ReflectionParameter $property) use ($class) {
            return [$property->getName() => Value::create($class, $property)];
        });

        if ($properties === null || $properties->count() === 0) {
            throw new InvalidBag(sprintf('Bag "%s" must have a constructor with at least one property', static::class));
        }

        $cache[$key] = $properties;

        return $properties;
    }
}
