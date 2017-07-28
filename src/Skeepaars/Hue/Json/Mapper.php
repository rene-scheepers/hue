<?php
declare(strict_types=1);

namespace Skeepaars\Hue\Json;

use Skeepaars\Hue\Models\Group;
use Skeepaars\Hue\Models\Light;
use Skeepaars\Hue\Models\RgbColor;

final class Mapper
{
    /**
     * @param int   $id
     * @param array $value
     *
     * @return Group
     *
     * @throws \Skeepaars\Hue\Lib\Exception
     */
    public static function toGroup(int $id, array $value): Group
    {
        return new Group(
            $id,
            $value['name'],
            array_map('intval', $value['lights']),
            array_key_exists('class', $value) ? static::toRoomClass($value['class']) : null,
            static::toGroupType($value['type']),
            static::toLightState($value['action'])
        );
    }

    /**
     * @param int   $id
     * @param array $value
     *
     * @return Light
     */
    public static function toLight(int $id, array $value): Light
    {
        return new Light(
            $id,
            static::toLightState($value['state']),
            $value['type'],
            $value['name'],
            $value['modelid'],
            $value['uniqueid'],
            $value['manufacturername'],
            '', // Not here yet on my version.
            $value['swversion']
        );
    }

    /**
     * @param array $value
     *
     * @return Light\State
     */
    private static function toLightState(array $value): Light\State
    {
        if (array_key_exists('xy', $value)) {
            $rgb = RgbColor::fromXY(
                $value['xy'][0],
                $value['xy'][1]
            );
        } else {
            $rgb = null;
        }

        return new Light\State(
            (bool)static::arrayValueOrElse('on', $value, true),
            static::arrayValueOrElse('bri', $value, 1),
            static::arrayValueOrElse('hue', $value, 0),
            $rgb,
            static::arrayValueOrElse('sat', $value, 0),
            static::arrayValueOrElse('ct', $value, 0),
            static::arrayValueOrElse('alert', $value, 'none'),
            static::arrayValueOrElse('effect', $value, 'none'),
            (bool)static::arrayValueOrElse('reachable', $value, false)
        );
    }

    /**
     * @param Group\RoomClass $roomClass
     *
     * @return string
     */
    public static function fromRoomClass(Group\RoomClass $roomClass): string
    {
        $name = $roomClass->getName();

        return ucfirst(strtolower(str_replace('_', ' ', $name)));
    }

    /**
     * @param Group\Type $groupType
     *
     * @return string
     */
    public static function fromGroupType(Group\Type $groupType): string
    {
        $name        = $groupType->getName();
        $nameUcWords = ucwords(strtolower($name), "_");

        return str_replace('_', '', $nameUcWords);
    }

    /**
     * @param string $value
     *
     * @return Group\RoomClass
     *
     * @throws \Skeepaars\Hue\Lib\Exception
     */
    private static function toRoomClass(string $value): Group\RoomClass
    {
        $searchValue = strtoupper(str_replace(' ', '_', $value));

        return Group\RoomClass::byName($searchValue);
    }

    /**
     * @param string $value
     *
     * @return Group\Type
     *
     * @throws \Skeepaars\Hue\Lib\Exception
     */
    private static function toGroupType(string $value): Group\Type
    {
        $searchValue = strtoupper($value);
        if ($searchValue === 'LIGHTGROUP') {
            $searchValue = 'LIGHT_GROUP';
        }

        return Group\Type::byName($searchValue);
    }

    /**
     * @param string $key
     * @param array  $array
     * @param mixed  $else
     *
     * @return mixed
     */
    private static function arrayValueOrElse(string $key, array $array, $else)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        return $else;
    }
}