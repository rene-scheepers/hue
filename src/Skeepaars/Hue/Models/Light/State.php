<?php

namespace Skeepaars\Hue\Models\Light;

class State
{
    /**
     * @var bool
     */
    private $toggled;

    /**
     * @var int
     */
    private $brightness;

    /**
     * @var int
     */
    private $hue;

    /**
     * @var int
     */
    private $saturation;

    /**
     * @var int
     */
    private $colorTemperature;

    /**
     * @var string
     */
    private $alert;

    /**
     * @var string
     */
    private $effect;

    /**
     * @var bool
     */
    private $reachable;

    /**
     * @param bool   $toggled
     * @param int    $brightness
     * @param int    $hue
     * @param int    $saturation
     * @param int    $colorTemperature
     * @param string $alert
     * @param string $effect
     * @param bool   $reachable
     */
    public function __construct(bool $toggled, int $brightness, int $hue, int $saturation, int $colorTemperature, string $alert, string $effect, bool $reachable)
    {
        $this->toggled          = $toggled;
        $this->brightness       = $brightness;
        $this->hue              = $hue;
        $this->saturation       = $saturation;
        $this->colorTemperature = $colorTemperature;
        $this->alert            = $alert;
        $this->effect           = $effect;
        $this->reachable        = $reachable;
    }

    /**
     * @return bool
     */
    public function isToggled(): bool
    {
        return $this->toggled;
    }

    /**
     * @return int
     */
    public function getBrightness(): int
    {
        return $this->brightness;
    }

    /**
     * @return int
     */
    public function getHue(): int
    {
        return $this->hue;
    }

    /**
     * @return int
     */
    public function getSaturation(): int
    {
        return $this->saturation;
    }

    /**
     * @return int
     */
    public function getColorTemperature(): int
    {
        return $this->colorTemperature;
    }

    /**
     * @return string
     */
    public function getAlert(): string
    {
        return $this->alert;
    }

    /**
     * @return string
     */
    public function getEffect(): string
    {
        return $this->effect;
    }

    /**
     * @return bool
     */
    public function isReachable(): bool
    {
        return $this->reachable;
    }
}