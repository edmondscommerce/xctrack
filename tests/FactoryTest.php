<?php

namespace EdmondsCommerce\XcTrack;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

    public function testCreateTaskFromGet()
    {
        $get = [
            'latString' => '54.62789327073978,54.638637697141085,54.61400724639677,54.63169411867934,54.63565372806588,54.64591798559728,54.58603278135878,54.63679917039689,54.61973624267634,54.61973624267634',
            'lonString' => '-3.073116412754075,-3.037820681843641,-3.0790849065502925,-3.108628173148645,-3.0256476696256414,-3.1512427173723836,-3.0726889564357407,-3.0209984368048026,-3.044831018955165,-3.044831018955165',
            'radString' => '400,400,400,400,400,400,2000,400,600,400',
            'routeName' => 'Blease DBLFAI (40k)'
        ];
        $task = Factory::createTaskFromGet($get);
        $json = $task->toJson();
        $this->assertContains('"taskType": "CLASSIC"', $json);
        file_put_contents(realpath(__DIR__ . '/../var/') . '/' . __METHOD__ . '.json', $json);
        $this->assertNotEmpty($json);
        $decoded = json_decode($json);
        $this->assertNotEmpty($decoded);
        $error = json_last_error_msg();
        $this->assertEquals('No error', $error);
    }
}
