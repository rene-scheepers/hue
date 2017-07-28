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
     */
    public static function toGroup(int $id, array $value): Group
    {
        return new Group(
            $id,
            $value['name'],
            array_map('intval', $value['lights']),
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
        print_r($value);

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