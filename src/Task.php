<?php

namespace EdmondsCommerce\XcTrack;

use EdmondsCommerce\XcTrack\Traits\JsonSerializable;

/**
 * Class Task
 * @package EdmondsCommerce\XcTrack
 * @see http://xctrack.org/Competition_Interfaces.html
 */
class Task implements \JsonSerializable
{
    /**
     * @var string
     */
    private $taskType = 'CLASSIC';

    /**
     * @var int
     */
    private $version = 1;

    /**
     * @var array|Turnpoint[]
     */
    private $turnpoints = [];

    /**
     * @var StartSpeedSection
     */
    private $sss;


    private $goal;

    use JsonSerializable;

    /**
     * Task constructor.
     * @param array|Turnpoint[] $turnpoints
     */
    public function __construct(array $turnpoints)
    {
        $this->turnpoints = $turnpoints;
        $this->sss = new StartSpeedSection();
        $this->goal = new Goal();
    }

    public function toJson()
    {
        return json_encode($this, JSON_PRETTY_PRINT);
    }
}
