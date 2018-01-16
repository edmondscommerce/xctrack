<?php

namespace EdmondsCommerce\XcTrack;

use EdmondsCommerce\XcTrack\Traits\JsonSerializable;

class Waypoint implements \JsonSerializable
{

    /**
     * Required name of waypoint
     *
     * @var string
     */
    private $name = '';


    /**
     * Required latitude - precision 16
     *
     * @var float
     */
    private $lat = 0.0;

    /**
     * Required longitude - precision 16
     *
     * @var float
     */
    private $lon = 0.0;

    /**
     * Optional description - if null will be set to $name
     * @var string
     */
    private $description = null;

    /**
     * Required altitude of the waypoint in meters AMSL
     * @var float
     */
    private $altSmoothed = 0.0;

    /**
     * Not sure what this is for - always set to false
     *
     * @var bool
     */
    private $isUnknown = false;

    use JsonSerializable;

    /**
     * Waypoint constructor.
     * @param string $name
     * @param float $lat
     * @param float $lon
     * @param string $description
     * @param float $altSmoothed
     * @param bool $isUnknown
     */
    public function __construct($name, $lat, $lon, $description = null, $altSmoothed = 0.0, $isUnknown = false)
    {
        $this->name = $name;
        $this->lat = floatval($lat);
        $this->lon = floatval($lon);
        $this->description = $description ?: $name;
        $this->altSmoothed = $altSmoothed;
        $this->isUnknown = $isUnknown;
    }


}
