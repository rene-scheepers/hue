<?php

namespace Skeepaars\Hue\Models;

class RgbColor
{
    /**
     * @var int
     */
    private $red;

    /**
     * @var int
     */
    private $blue;

    /**
     * @var int
     */
    private $green;

    /**
     * @var float
     */
    private $hueX;

    /**
     * @var float
     */
    private $hueY;

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     */
    public function __construct(int $red, int $green, int $blue)
    {
        $this->red   = $red;
        $this->blue  = $blue;
        $this->green = $green;

        $conversionRed   = $this->red / 255;
        $conversionGreen = $this->green / 255;
        $conversionBlue  = $this->blue / 255;

        $x = $conversionRed * 0.664511 + $conversionGreen * 0.154324 + $conversionBlue * 0.162028;
        $y = $conversionRed * 0.283881 + $conversionGreen * 0.668433 + $conversionBlue * 0.047685;
        $z = $conversionRed * 0.000088 + $conversionGreen * 0.072310 + $conversionBlue * 0.986039;

        $this->hueX = $x / ($x + $y + $z);
        $this->hueY = $y / ($x + $y + $z);
    }

    /**
     * @return int
     */
    public function getRed(): int
    {
        return $this->red;
    }

    /**
     * @return int
     */
    public function getBlue(): int
    {
        return $this->blue;
    }

    /**
     * @return int
     */
    public function getGreen(): int
    {
        return $this->green;
    }

    /**
     * @return float
     */
    public function getHueX(): float
    {
        return $this->hueX;
    }

    /**
     * @return float
     */
    public function getHueY(): float
    {
        return $this->hueY;
    }
}