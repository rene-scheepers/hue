<?php
declare(strict_types=1);

namespace Skeepaars\Hue\Models\Group;

use Skeepaars\Hue\Lib\Enum;

/**
 * @method static Type LUMINAIRE()
 * @method static Type LIGHTSOURCE()
 * @method static Type LIGHT_GROUP()
 * @method static Type ROOM()
 */
final class Type extends Enum
{
    protected const LUMINAIRE   = 0;
    protected const LIGHTSOURCE = 0;
    protected const LIGHT_GROUP = 0;
    protected const ROOM        = 0;
}