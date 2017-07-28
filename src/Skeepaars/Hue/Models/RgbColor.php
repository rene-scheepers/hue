<?php
declare(strict_types=1);

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

    public static function fromXY(float $x, float $y): self
    {
        $z = 1 - $x - $y;

        $red   = $x * 1.656492 - $y * 0.354851 - $z * 0.255038;
        $green = -$x * 0.707196 + $y * 1.655397 + $z * 0.036152;
        $blue  = $x * 0.051713 - $y * 0121364 + $z * 1.011530;

        return new self(
            (int)$red,
            (int)$green,
            (int)$blue
        );
    }
}