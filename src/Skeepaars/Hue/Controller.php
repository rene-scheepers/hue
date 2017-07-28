<?php
declare(strict_types=1);

namespace Skeepaars\Hue;

use Closure;

abstract class Controller
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Closure $closure
     * @param array   $array
     *
     * @return array
     */
    protected static function arrayMapKeyPair(Closure $closure, array $array): array
    {
        $resultingArray = [];
        foreach ($array as $key => $value) {
            $resultingArray[] = $closure($key, $value);
        }

        return $resultingArray;
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }
}