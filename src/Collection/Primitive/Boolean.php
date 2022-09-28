<?php

declare(strict_types=1);

namespace MichaelRubel\ValueObjects\Collection\Primitive;

use MichaelRubel\ValueObjects\ValueObject;

/**
 * @method static static make(bool|int|string $value)
 * @method static static from(bool|int|string $value)
 */
class Boolean extends ValueObject
{
    /**
     * Allowed values that are treated as `true`.
     *
     * @var array
     */
    protected array $trueValues = ['1', 'true', 'True', 'TRUE', 1, true];

    /**
     * Allowed values that are treated as `false`.
     *
     * @var array
     */
    protected array $falseValues = ['0', 'false', 'False', 'FALSE', 0, false];

    /**
     * Create a new instance of the value object.
     *
     * @param  bool|int|string  $value
     */
    public function __construct(protected bool|int|string $value)
    {
        $this->value = match (true) {
            $this->isTrue()  => true,
            $this->isFalse() => false,
            default => throw new \InvalidArgumentException('Invalid boolean'),
        };
    }

    /**
     * Get the object value.
     *
     * @return bool
     */
    public function value(): bool
    {
        return (bool) $this->value;
    }

    /**
     * Determine if the passed boolean is a positive value.
     *
     * @return bool
     */
    protected function isTrue(): bool
    {
        return in_array($this->value, $this->trueValues, strict: true);
    }

    /**
     * Determine if the passed boolean is a negative value.
     *
     * @return bool
     */
    protected function isFalse(): bool
    {
        return in_array($this->value, $this->falseValues, strict: true);
    }

    /**
     * Get string representation of the value object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return ! empty($this->value()) ? 'true' : 'false';
    }
}
