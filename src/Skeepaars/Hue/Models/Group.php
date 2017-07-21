<?php

namespace Skeepaars\Hue\Models;

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
     * @param int         $id
     * @param string      $name
     * @param int[]       $lights
     * @param Light\State $action
     */
    public function __construct(int $id, string $name, array $lights, Light\State $action)
    {
        $this->id     = $id;
        $this->name   = $name;
        $this->lights = $lights;
        $this->action = $action;
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
     * @return Light\State
     */
    public function getAction(): Light\State
    {
        return $this->action;
    }
}