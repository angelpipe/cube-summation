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
        $result['output'] = array();

        // Analyze and process each command
        $line = 1;
        foreach ($this->commands as $command) {
            $parts = explode(' ', $command);
            if ($this->remaining_queries == 0) {
                // Expect an init command
                if ($this->validateInit($parts)) {
                    $this->cube->init($parts[0]);
                    $this->remaining_queries = $parts[1];
                } else {
                    $result['error_line'] = $line;
                    $result['error'] = 'Wrong init line. Format is "N M" with N < 100 and M < 1000.';
                    break;
                }
            } else {
                // Expect a query
                switch ($parts[0]) {
                    case 'UPDATE':
                        if ($this->validateUpdate($parts)) {
                            $this->cube->update($parts[1], $parts[2], $parts[3], $parts[4]);
                        } else {
                            $result['error_line'] = $line;
                            $result['error'] = 'Wrong query. Format is "UPDATE X Y Z W". X, Y, Z cannot exceed N.';
                            break 2;
                        }
                        break;
                    case 'QUERY':
                        if ($this->validateSummation($parts)) {
                            $sum = $this->cube->summate($parts[1], $parts[2], $parts[3], $parts[4], $parts[5],
                                                        $parts[6]);
                            $result['output'][] = $sum;
                        } else {
                            $result['error_line'] = $line;
                            $result['error'] = 'Wrong query. Format is "QUERY X1 Y1 Z1 X2 Y2 Z2". X, Y, Z cannot '
                                             . 'exceed N and second values need to be higher.';
                            break 2;
                        }
                        break;
                    default:
                        $result['error_line'] = $line;
                        $result['error'] = 'Unrecognized query.';
                        break 2;
                }
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
    public function validateInit ($command)
    {
        if (count($command) != 2) {
            return false;
        } else if (!is_numeric($command[0]) || !is_numeric($command[1])) {
            return false;
        } else if ($command[0] > 100 || $command[0] < 1 || $command[1] > 1000 || $command[1] < 1) {
            return false;
        }

        return true;
    }

    /**
     * Validate an update query.
     *
     * @param array    $query  query exploded into an array
     *
     * @return bool
     */
    public function validateUpdate ($query)
    {
        $size = $this->cube->getSize();
        if (count($query) != 5) {
            return false;
        } else if (!is_numeric($query[1])) {
            return false;
        } else if (!is_numeric($query[2])) {
            return false;
        } else if (!is_numeric($query[3])) {
            return false;
        } else if (!is_numeric($query[4])) {
            return false;
        } else if ($query[1] > $size || $query[2] > $size || $query[3] > $size) {
            return false;
        } else if ($query[1] < 1 || $query[2] < 1 || $query[3] < 1) {
            return false;
        }

        return true;
    }

    /**
     * Validate a summate query.
     *
     * @param array    $query  query exploded into an array
     *
     * @return bool
     */
    public function validateSummation ($query)
    {
        $size = $this->cube->getSize();
        if (count($query) != 7) {
            return false;
        } else if (!is_numeric($query[1])) {
            return false;
        } else if (!is_numeric($query[2])) {
            return false;
        } else if (!is_numeric($query[3])) {
            return false;
        } else if (!is_numeric($query[4])) {
            return false;
        } else if (!is_numeric($query[5])) {
            return false;
        } else if (!is_numeric($query[6])) {
            return false;
        } else if ($query[1] > $size) {
            return false;
        } else if ($query[2] > $size) {
            return false;
        } else if ($query[3] > $size) {
            return false;
        } else if ($query[4] > $size) {
            return false;
        } else if ($query[5] > $size) {
            return false;
        } else if ($query[6] > $size) {
            return false;
        } else if ($query[1] < 1 || $query[2] < 1 || $query[3] < 1 || $query[4] < 1 || $query[5] < 1 || $query[6] < 1) {
            return false;
        } else if ($query[1] > $query[4] || $query[2] > $query[5] || $query[3] > $query[6]) {
            return false;
        }

        return true;
    }
}
