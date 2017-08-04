<?php

namespace Skeepaars\Hue\Models\Sensor;

class Configuration
{
    /**
     * @var bool
     */
    private $on;

    /**
     * @var bool
     */
    private $reachable;

    /**
     * @var int|null
     */
    private $battery;

    /**
     * @param bool     $on
     * @param bool     $reachable
     * @param int|null $battery
     */
    public function __construct(bool $on, bool $reachable, ?int $battery)
    {
        $this->on        = $on;
        $this->reachable = $reachable;
        $this->battery   = $battery;
    }

    /**
     * @return bool
     */
    public function isOn(): bool
    {
        return $this->on;
    }

    /**
     * @return bool
     */
    public function isReachable(): bool
    {
        return $this->reachable;
    }

    /**
     * @return int|null
     */
    public function getBattery()
    {
        return $this->battery;
    }
}