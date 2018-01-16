<?php

namespace EdmondsCommerce\XcTrack;

use EdmondsCommerce\XcTrack\Traits\JsonSerializable;

class Goal implements \JsonSerializable
{
    /**
     * LINE or CYLINDER.
     * In the case of line, the radius of the turnpoint corresponds to the 1/2 of the total length of the goal line.
     * Ground orientation of the line is always perpendicular to the azimuth to the center of last turnpoint
     *
     * @var string
     */
    private $type = 'CYLINDER';

    /**
     *  time corresponding to both the task deadline and goal deadline
     * @var string
     */
    private $deadline = '23:00:00Z';

    use JsonSerializable;
}
