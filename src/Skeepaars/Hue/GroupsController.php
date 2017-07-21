<?php

namespace Skeepaars\Hue;

use Skeepaars\Hue\Json\Mapper;
use Skeepaars\Hue\Models\Exception;
use Skeepaars\Hue\Models\Group;

class GroupsController extends Controller
{

    /**
     * @return Group[]
     *
     * @throws Exception
     */
    public function getGroups(): array
    {
        $response = $this->getClient()->get("/groups");

        return static::arrayMapKeyPair(
            function ($key, array $value) {
                return Mapper::toGroup($key, $value);
            },
            $response
        );
    }

    /**
     * @param int $id
     *
     * @return Group
     *
     * @throws Exception
     */
    public function getGroup(int $id): Group
    {
        $response = $this->getClient()->get("/groups/$id");

        return Mapper::toGroup($id, $response);
    }

}