<?php

namespace EdmondsCommerce\XcTrack;

use EdmondsCommerce\XcTrack\Traits\JsonSerializable;

class StartSpeedSection implements \JsonSerializable
{
    /**
     * RACE for the race to goal start type or time gates
     * ELAPSED-TIME for elapsed-time start type
     *
     * @var string
     */
    private $type = 'ELAPSED-TIME';

    /**
     * Direction of crossing the start cylinder
     * One of ENTER or EXIT
     *
     * @var string
     */
    private $direction = 'ENTER';

    /**
     * In most cases array with just one window opening time.
     * For time gates start:
     * array of times for each gate, ordered chronologically
     *
     * @var array
     */
    private $timeGates = [
        "01:00:00Z"
    ];

    use JsonSerializable;
}
