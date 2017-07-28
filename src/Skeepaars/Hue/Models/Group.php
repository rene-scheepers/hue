<?php
declare(strict_types=1);

namespace Skeepaars\Hue\Models;

use Skeepaars\Hue\Models\Group\RoomClass;
use Skeepaars\Hue\Models\Group\Type;

class Group
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int[]
     */
    private $lights;

    /**
     * @var Light\State
     */
    private $action;

    /**
     * @var RoomClass|null
     */
    private $roomClass;

    /**
     * @var Type
     */
    private $type;

    /**
     * @param int         $id
     * @param string      $name
     * @param int[]       $lights
     * @param RoomClass|null   $roomClass
     * @param Type        $type
     * @param Light\State $action
     */
    public function __construct(int $id, string $name, array $lights, ?RoomClass $roomClass, Type $type, Light\State $action)
    {
        $this->id        = $id;
        $this->name      = $name;
        $this->lights    = $lights;
        $this->action    = $action;
        $this->roomClass = $roomClass;
        $this->type      = $type;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int[]
     */
    public function getLights(): array
    {
        return $this->lights;
    }

    /**
     * @return RoomClass|null
     */
    public function getRoomClass(): ?RoomClass
    {
        return $this->roomClass;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return Light\State
     */
    public function getAction(): Light\State
    {
        return $this->action;
    }
}