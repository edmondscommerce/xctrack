<?php

namespace EdmondsCommerce\XcTrack;

use EdmondsCommerce\XcTrack\Traits\JsonSerializable;

class Turnpoint implements \JsonSerializable
{
    const TYPE_TAKEOFF = 'TAKEOFF';
    const TYPE_START_SPEED_SECTION = 'SSS';
    const TYPE_END_SPEED_SECTION = 'ESS';

    /**
     * Radius of turnpoint in metres
     * @var float
     */
    private $radius = 400.0;

    /**
     * @var Waypoint
     */
    private $waypoint;

    /**
     * Optional type - if null will be excluded
     *
     * @var null|'TAKEOFF'|'SSS'|'ESS'
     */
    private $type = null;

    use JsonSerializable;

    /**
     * Turnpoint constructor.
     * @param Waypoint $waypoint
     * @param float $radius
     * @param null $type
     * @throws Exception
     */
    public function __construct(Waypoint $waypoint, $radius = 400.0, $type = null)
    {
        $this->waypoint = $waypoint;
        $this->radius = floatval($radius);
        if (!in_array($type, [null, 'TAKEOFF', 'SSS', 'ESS'])) {
            throw new Exception(
                'Invalid type ' . $type
                . ', should be either null or one of '
                . "'TAKEOFF', 'SSS', 'ESS'");
        }
        $this->type = $type;
    }


}
