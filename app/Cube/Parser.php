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

    /**
     * The commands queue.
     *
     * @var array
     */
    protected $commands;

    /**
     * The quantity of queries that remain to be done.
     *
     * @var int
     */
    protected $remaining_queries;

    public function __construct (Cube $cube)
    {
        $this->cube = $cube;
        $this->remaining_queries = 0;
    }

    /**
     * Parse user input commands.
     *
     * @param string    $input  user input commands
     *
     * @return array
     */
    public function parse ($input)
    {
        $result = array();
        $this->commands = preg_split("/\\r\\n|\\r|\\n/", $input);
        $result['commands'] = $this->commands;

        // Analyze and process each command
        $line = 1;
        foreach ($this->commands as $command) {
            $parts = explode(' ', $command);
            if ($this->remaining_queries == 0) {
                // Expect a init command
                if ($this->validate_init($parts)) {
                    $this->cube->init($parts[0]);
                    $this->remaining_queries = $parts[1];
                } else {
                    $result['error_line'] = $line;
                    $result['error'] = 'Wrong init line. Format is: "N M" with N < 100 and M < 1000';
                    break;
                }
            } else {
                // Expect a query
                $this->remaining_queries--;
            }
            $line++;
        }

        return $result;
    }

    /**
     * Validate an init command.
     *
     * @param array    $command  command exploded into an array
     *
     * @return bool
     */
    public function validate_init ($command)
    {
        if (count($command) != 2) {
            return false;
        } else if (!is_numeric($command[0]) || !is_numeric($command[0])) {
            return false;
        } else if ($command[0] > 100 || $command[1] > 1000) {
            return false;
        }

        return true;
    }
}
