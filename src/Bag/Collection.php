<?php

declare(strict_types=1);

namespace Bag;

use Bag\Exceptions\ImmutableCollectionException;
use Illuminate\Support\Collection as LaravelCollection;
use Override;

class Collection extends LaravelCollection
{
    #[Override]
    public function forget($keys)
    {
        return (clone $this)->forget($keys);
    }

    #[Override]
    public function pop($count = 1)
    {
        return (clone $this)->pop($count);
    }

    #[Override]
    public function prepend($value, $key = null)
    {
        return (clone $this)->prepend($value, $key);
    }

    #[Override]
    public function pull($key, $default = null)
    {
        throw new ImmutableCollectionException('Method pull is not allowed on ' . static::class);
    }

    #[Override]
    public function push(...$values)
    {
        return (clone $this)->push(...$values);
    }

    #[Override]
    public function put($key, $value)
    {
        return (clone $this)->put($key, $value);
    }

    #[Override]
    public function shift($count = 1)
    {
        throw new ImmutableCollectionException('Method shift is not allowed on ' . static::class);
    }

    #[Override]
    public function splice($offset, $length = null, $replacement = [])
    {
        throw new ImmutableCollectionException('Method splice is not allowed on ' . static::class);
    }

    #[Override]
    public function transform(callable $callback)
    {
        throw new ImmutableCollectionException('Method transform is not allowed on ' . static::class);
    }

    #[Override]
    public function getOrPut($key, $value)
    {
        throw new ImmutableCollectionException('Method getOrPut is not allowed on ' . static::class);
    }

    #[Override]
    public function offsetSet($key, $value): void
    {
        throw new ImmutableCollectionException('Array key writes not allowed on ' . static::class);
    }

    #[Override]
    public function offsetUnset($key): void
    {
        throw new ImmutableCollectionException('Array key writes not allowed on ' . static::class);
    }

    public function __set($name, $value): void
    {
        throw new ImmutableCollectionException('Property writes not allowed on ' . static::class);
    }
}
