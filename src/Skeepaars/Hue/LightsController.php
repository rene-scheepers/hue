<?php
declare(strict_types=1);

namespace Skeepaars\Hue;

use InvalidArgumentException;
use Skeepaars\Hue\Json\Mapper;
use Skeepaars\Hue\Models\Exception;
use Skeepaars\Hue\Models\Light;
use Skeepaars\Hue\Models\RgbColor;

class LightsController extends Controller
{

    /**
     * @return Light[]
     *
     * @throws Exception
     */
    public function getLights(): array
    {
        $response = $this->getClient()->get("/lights");

        return static::arrayMapKeyPair(
            function ($key, array $value) {
                return Mapper::toLight($key, $value);
            },
            $response
        );
    }

    /**
     * @param int $id
     *
     * @return Light
     *
     * @throws Exception
     */
    public function getLight(int $id): Light
    {
        $response = $this->getClient()->get("/lights/$id");

        return Mapper::toLight($id, $response);
    }

    /**
     * @param int $id
     *
     * @throws Models\Exceptions\CouldNotDecodeJsonException
     * @throws Models\Exceptions\HueRequestException
     * @throws Models\Exceptions\HueResourceNotFoundException
     */
    public function toggleLightOff(int $id)
    {
        $this->getClient()->put(
            "/lights/$id/state",
            ['on' => false]
        );
    }

    /**
     * @param int           $id
     * @param int|null      $brightness
     * @param RgbColor|null $color
     * @param int|null      $transitionTime
     *
     * @throws Models\Exceptions\CouldNotDecodeJsonException
     * @throws Models\Exceptions\HueRequestException
     * @throws Models\Exceptions\HueResourceNotFoundException
     */
    public function setState(int $id, ?int $brightness = 254, ?RgbColor $color = null, ?int $transitionTime = null)
    {
        $parameters = [
            'on' => true,
        ];

        if ($brightness !== null) {
            if ($brightness > 254) {
                throw new InvalidArgumentException("Brightness value of above 254 is not possible");
            }

            $parameters['bri'] = $brightness;
        }

        if ($color !== null) {
            $parameters['xy'] = [
                $color->getHueX(),
                $color->getHueY(),
            ];
        }

        if ($transitionTime !== null) {
            $parameters['transitiontime'] = $transitionTime;
        }

        $this->getClient()->put(
            "/lights/$id/state",
            $parameters
        );
    }

}