<?php
declare(strict_types=1);

namespace Skeepaars\Hue;

use InvalidArgumentException;
use Skeepaars\Hue\Json\Mapper;
use Skeepaars\Hue\Models\Exception;
use Skeepaars\Hue\Models\Light;
use Skeepaars\Hue\Models\RgbColor;
use Skeepaars\Hue\Models\Sensor;

class SensorsController extends Controller
{
    /**
     * @return Sensor[]
     *
     * @throws Models\Exceptions\CouldNotDecodeJsonException
     * @throws Models\Exceptions\HueRequestException
     * @throws Models\Exceptions\HueResourceNotFoundException
     */
    public function get(): array
    {
        return static::arrayMapKeyPair(
            function ($key, array $value) {
                return Mapper::toSensor($key, $value);
            },
            $this->getClient()->get("/sensors")
        );
    }

    /**
     * @param int $id
     *
     * @return Sensor
     *
     * @throws Models\Exceptions\CouldNotDecodeJsonException
     * @throws Models\Exceptions\HueRequestException
     * @throws Models\Exceptions\HueResourceNotFoundException
     */
    public function getById(int $id): Sensor
    {
        return Mapper::toSensor($id, $this->getClient()->get("/sensors/$id"));
    }

}