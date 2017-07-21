<?php

namespace Skeepaars\Hue;

use Skeepaars\Hue\Models\Exceptions\CouldNotDecodeJsonException;
use Skeepaars\Hue\Models\Exceptions\HueRequestException;
use Skeepaars\Hue\Models\Exceptions\HueResourceNotFoundException;

class Client
{
    /**
     * @var string
     */
    private $baseUri;


    /**
     * @param string $bridgeUri
     * @param string $username
     */
    public function __construct(string $bridgeUri, string $username)
    {
        $uri = "{$bridgeUri}/api/{$username}";

        $this->baseUri = $uri;
    }

    /**
     * @param string $uri
     *
     * @return mixed
     *
     * @throws CouldNotDecodeJsonException
     * @throws HueRequestException
     * @throws HueResourceNotFoundException
     */
    public function get(string $uri)
    {
        return $this->curl($uri);
    }

    /**
     * @param string $uri
     * @param        $body
     *
     * @return mixed
     *
     * @throws CouldNotDecodeJsonException
     * @throws HueRequestException
     * @throws HueResourceNotFoundException
     */
    public function put(string $uri, $body)
    {
        $json = json_encode($body);

        $options = [
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS    => $json,
        ];

        return $this->curl($uri, $options);
    }

    /**
     * @param array $options
     *
     * @return mixed
     *
     * @throws CouldNotDecodeJsonException
     * @throws HueRequestException
     * @throws HueResourceNotFoundException
     */
    private function curl(string $uri, array $options = [])
    {
        $curlHandle = curl_init();
        $options    = [
                CURLOPT_URL            => $this->baseUri . $uri,
                CURLOPT_RETURNTRANSFER => true,
            ] + $options;

        print_r($options);

        try {
            curl_setopt_array($curlHandle, $options);

            $response = curl_exec($curlHandle);

            $curlErrorNumber = curl_errno($curlHandle);
            if ($curlErrorNumber !== 0) {
                $errorDescription = curl_error($curlHandle);

                throw new HueRequestException($errorDescription);
            }

            $info = curl_getinfo($curlHandle);
            if ($info['http_code'] >= 400) {
                throw new HueRequestException("HTTP error code {$info['http_code']}");
            }

            if ($info['content_type'] !== 'application/json') {
                throw new HueRequestException("Server did not return content type json");
            }

            $decoded = json_decode($response, true);
            if ($decoded === null) {
                // Could not decode.
                throw new CouldNotDecodeJsonException("Could not decode JSON.");
            }

            if (array_key_exists(0, $decoded) && array_key_exists('error', $decoded[0])) {
                $error = $decoded[0]['error'];

                switch ($error['type']) {
                    case 3:
                        throw new HueResourceNotFoundException($error['description']);
                    default:
                        throw new HueRequestException($error['description']);
                }
            }

            return $decoded;

        } finally {
            curl_close($curlHandle);
        }
    }

}