<?php
declare(strict_types=1);

namespace Skeepaars\Hue\Lib;

use ReflectionClass;

abstract class Enum
{
    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Enum $other
     *
     * @return bool
     */
    public function equals(self $other)
    {
        return $other === $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     *
     * @throws Exception
     */
    public static function byName(string $name): self
    {
        $instances = static::getInstancesForClass(get_called_class());

        if (array_key_exists($name, $instances)) {
            return $instances[$name];
        } else {
            echo $name;

            print_r(self::$instances);
            throw new Exception("Enum with name: '$name' does not exist");
        }
    }

    /**
     * @param string $class
     *
     * @return array
     */
    private static function getInstancesForClass(string $class)
    {
        if (!array_key_exists($class, self::$instances)) {
            $reflectionClass = new ReflectionClass($class);
            $constants       = $reflectionClass->getConstants();

            $instances = [];
            foreach ($constants as $constant => $ignored) {
                $instances[$constant] = new $class($constant);
            }

            self::$instances[$class] = $instances;
        }

        return self::$instances[$class];
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return Enum
     *
     * @throws Exception
     */
    public static function __callStatic($name, $arguments): self
    {
        return static::byName($name);
    }
}