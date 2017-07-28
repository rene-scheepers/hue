<?php

namespace Skeepaars\Hue\Models\Sensor;

use Skeepaars\Hue\Lib\Enum;

/**
 * @method static Type ZGP_SWITCH()
 * @method static Type ZLL_SWITCH()
 * @method static Type ZLL_PRESENCE()
 * @method static Type ZLL_TEMPERATURE()
 * @method static Type CLIP_SWITCH()
 * @method static Type CLIP_OPEN_CLOSE()
 * @method static Type CLIP_PRESENCE()
 * @method static Type CLIP_TEMPERATURE()
 * @method static Type CLIP_HUMIDITY()
 * @method static Type DAYLIGHT()
 * @method static Type CLIP_LIGHT_LEVEL()
 * @method static Type ZLL_LIGHT_LEVEL()
 * @method static Type CLIP_GENERIC_FLAG()
 * @method static Type CLIP_GENERIC_STATUS()
 */
final class Type extends Enum
{
    protected const ZGP_SWITCH          = 0; // Hue Tap
    protected const ZLL_SWITCH          = 0; // Hue Wireless Dimmer Switch
    protected const ZLL_PRESENCE        = 0; // Hue Motion Sensor
    protected const ZLL_TEMPERATURE     = 0;
    protected const CLIP_SWITCH         = 0;
    protected const CLIP_OPEN_CLOSE     = 0;
    protected const CLIP_PRESENCE       = 0;
    protected const CLIP_TEMPERATURE    = 0;
    protected const CLIP_HUMIDITY       = 0;
    protected const DAYLIGHT            = 0;
    protected const CLIP_LIGHT_LEVEL    = 0;
    protected const ZLL_LIGHT_LEVEL     = 0;
    protected const CLIP_GENERIC_FLAG   = 0;
    protected const CLIP_GENERIC_STATUS = 0;
}