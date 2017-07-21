<?php

namespace Skeepaars\Hue;

use Skeepaars\Hue\Json\Mapper;
use Skeepaars\Hue\Models\Exception;
use Skeepaars\Hue\Models\Light;

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

    public function setState(int $id)
    {
        print_r(
            $this->getClient()->put(
                "/lights/$id",
                [
                    'on' => true,
                ]
            )
        );
    }

}