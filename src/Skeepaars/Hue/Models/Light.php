<?php
declare(strict_types=1);

namespace Skeepaars\Hue\Models;

use Skeepaars\Hue\Models\Light\State;

class Light
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var State
     */
    private $state;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $modelId;

    /**
     * @var string
     */
    private $uqiqueId;

    /**
     * @var string
     */
    private $manufacturerName;

    /**
     * @var string
     */
    private $luminaireUniqueId;

    /**
     * @var string
     */
    private $softwareVersion;

    /**
     * @param int    $id
     * @param State  $state
     * @param string $type
     * @param string $name
     * @param string $modelId
     * @param string $uqiqueId
     * @param string $manufacturerName
     * @param string $luminaireUniqueId
     * @param string $softwareVersion
     */
    public function __construct(int $id, State $state, string $type, string $name, string $modelId, string $uqiqueId, string $manufacturerName, string $luminaireUniqueId, string $softwareVersion)
    {
        $this->id                = $id;
        $this->state             = $state;
        $this->type              = $type;
        $this->name              = $name;
        $this->modelId           = $modelId;
        $this->uqiqueId          = $uqiqueId;
        $this->manufacturerName  = $manufacturerName;
        $this->luminaireUniqueId = $luminaireUniqueId;
        $this->softwareVersion   = $softwareVersion;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getModelId(): string
    {
        return $this->modelId;
    }

    /**
     * @return string
     */
    public function getUqiqueId(): string
    {
        return $this->uqiqueId;
    }

    /**
     * @return string
     */
    public function getManufacturerName(): string
    {
        return $this->manufacturerName;
    }

    /**
     * @return string
     */
    public function getLuminaireUniqueId(): string
    {
        return $this->luminaireUniqueId;
    }

    /**
     * @return string
     */
    public function getSoftwareVersion(): string
    {
        return $this->softwareVersion;
    }
}