<?php

namespace App\Cube;

class Parser
{
    /**
     * The cube object.
     *
     * @var Cube
     */
    protected $cube;

    public function __construct (Cube $cube)
    {
        $this->cube = $cube;
    }
}
