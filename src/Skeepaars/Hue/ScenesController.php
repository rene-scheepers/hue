<?php
declare(strict_types=1);

namespace Skeepaars\Hue;

use InvalidArgumentException;
use Skeepaars\Hue\Json\Mapper;
use Skeepaars\Hue\Models\Exception;
use Skeepaars\Hue\Models\Light;
use Skeepaars\Hue\Models\RgbColor;

class ScenesController extends Controller
{

    public function get()
    {
        return $this->getClient()->get("/scenes");
    }

}