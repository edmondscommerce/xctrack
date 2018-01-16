<?php

namespace EdmondsCommerce\XcTrack\Traits;


trait JsonSerializable
{
    public function jsonSerialize()
    {
        $var = get_object_vars($this);
        foreach ($var as $key => &$value) {
            if ($value === null) {
                unset($var[$key]);
            }
            if (is_object($value) && method_exists($value, 'getJsonData')) {
                $value = $value->getJsonData();
            }
        }
        return $var;
    }
}
