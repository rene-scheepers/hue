<?php
declare(strict_types=1);

namespace Skeepaars\Hue\Models;

use Skeepaars\Hue\Models\Sensor\Configuration;
use Skeepaars\Hue\Models\Sensor\Type;

class Sensor
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @param int           $id
     * @param string        $name
     * @param Type          $type
     * @param Configuration $configuration
     */
    public function __construct(int $id, string $name, Type $type, Configuration $configuration)
    {
        $this->id            = $id;
        $this->name          = $name;
        $this->type          = $type;
        $this->configuration = $configuration;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }
}