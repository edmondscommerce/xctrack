<?php

namespace EdmondsCommerce\XcTrack;


class Factory
{
    const GET_PARAM_LATITUDES = 'latString';
    const GET_PARAM_LONGITUDES = 'lonString';
    const GET_PARAM_RADIUSES = 'radString';
    const GET_PARAM_TASK_NAME = 'routeName';

    /**
     * Build the Task object from get array.
     *
     * Will access the $_GET super global if no array passed in
     *
     * @param array|null $get
     * @return Task
     */
    public static function createTaskFromGet(array $get = null)
    {
        if (null === $get) {
            $get = $_GET;
        }
        $lats = explode(',', $get[self::GET_PARAM_LATITUDES]);
        $longs = explode(',', $get[self::GET_PARAM_LONGITUDES]);
        $rads = explode(',', $get[self::GET_PARAM_RADIUSES]);

        $turnpoints = [];

        $turnpointPrefix = substr(strtoupper(preg_replace(
                '%[^a-z0-9]%i',
                '',
                $get[self::GET_PARAM_TASK_NAME]
            )), 0, 3) . '-';


        $numTurnpoints = count($get[self::GET_PARAM_LATITUDES]);

        $startKey = 0;
        $essKey = $numTurnpoints - 2;

        foreach ($lats as $key => $lat) {
            $turnpointName = $turnpointPrefix . $key;
            if ($key === $startKey) {
                $turnpoints[] = self::createTurnpoint(
                    $turnpointName . '-takeoff',
                    $lat,
                    $longs[$key],
                    $rads[$key],
                    Turnpoint::TYPE_TAKEOFF
                );
                $turnpoints[] = self::createTurnpoint(
                    $turnpointName,
                    $lat,
                    $longs[$key],
                    $rads[$key],
                    Turnpoint::TYPE_START_SPEED_SECTION
                );
            } elseif ($key === $essKey) {
                $turnpoints[] = self::createTurnpoint(
                    $turnpointName,
                    $lat,
                    $longs[$key],
                    $rads[$key],
                    Turnpoint::TYPE_END_SPEED_SECTION
                );
            } else {
                $turnpoints[] = self::createTurnpoint(
                    $turnpointName,
                    $lat,
                    $longs[$key],
                    $rads[$key]
                );
            }
        }

        $task = new Task($turnpoints);

        return $task;

    }

    public static function createTurnpoint($name, $lat, $long, $radius, $type = null)
    {
        $waypoint = new Waypoint($name, $lat, $long);
        $turnpoint = new Turnpoint($waypoint, $radius, $type);
        return $turnpoint;
    }
}
