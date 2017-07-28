<?php
declare(strict_types=1);

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
    public function get(): array
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
     * @throws Lib\Exception
     * @throws Models\Exceptions\CouldNotDecodeJsonException
     * @throws Models\Exceptions\HueRequestException
     * @throws Models\Exceptions\HueResourceNotFoundException
     */
    public function getById(int $id): Group
    {
        $response = $this->getClient()->get("/groups/$id");

        return Mapper::toGroup($id, $response);
    }

    /**
     * @param string          $name
     * @param Group\Type      $type
     * @param Group\RoomClass $class
     * @param int[]           $lights
     *
     * @return int
     *
     * @throws Models\Exceptions\CouldNotDecodeJsonException
     * @throws Models\Exceptions\HueRequestException
     * @throws Models\Exceptions\HueResourceNotFoundException
     */
    public function create(string $name, Group\Type $type, ?Group\RoomClass $class, array $lights): int
    {
        $parameters = [
            "name"   => $name,
            "type"   => Mapper::fromGroupType($type),
            "lights" => array_map('strval', $lights),
        ];

        if ($class !== null) {
            if (!$type->equals(Group\Type::ROOM())) {
                throw new \InvalidArgumentException("Room class is only available when type is room");
            }

            $parameters['class'] = Mapper::fromRoomClass($class);
        }

        $response = $this->getClient()->post("/groups", $parameters);

        return (int)$response[0]["success"]["id"];
    }

    /**
     * @param int                  $id
     * @param string               $name
     * @param null|Group\RoomClass $class
     * @param int[]                $lights
     *
     * @throws Models\Exceptions\CouldNotDecodeJsonException
     * @throws Models\Exceptions\HueRequestException
     * @throws Models\Exceptions\HueResourceNotFoundException
     */
    public function update(int $id, string $name, ?Group\RoomClass $class, array $lights)
    {
        $parameters = [
            "name"   => $name,
            "lights" => array_map('strval', $lights),
        ];

        if ($class !== null) {
            $parameters['class'] = Mapper::fromRoomClass($class);
        }

        $this->getClient()->put("/groups/$id", $parameters);
    }

    /**
     * @param int $id
     *
     * @throws Models\Exceptions\CouldNotDecodeJsonException
     * @throws Models\Exceptions\HueRequestException
     * @throws Models\Exceptions\HueResourceNotFoundException
     */
    public function delete(int $id)
    {
        $this->getClient()->delete("/groups/$id");
    }

}