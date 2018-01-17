<?php
/**
 *
 * Here is a simple example of how to use this library to offer a download
 *
 * This is not using composer autoloading
 *
 */

if (empty($_GET)) {
    ?>
    <h1>No Get Params Supplied</h1>
    For testing <a
            href="//<?php echo $_SERVER['HTTP_HOST'] ?>/<?php echo $_SERVER['REQUEST_URI'] ?>?latString=54.62789327073978,54.638637697141085,54.61400724639677,54.63169411867934,54.63565372806588,54.64591798559728,54.58603278135878,54.63679917039689,54.61973624267634,54.61973624267634&lonString=-3.073116412754075,-3.037820681843641,-3.0790849065502925,-3.108628173148645,-3.0256476696256414,-3.1512427173723836,-3.0726889564357407,-3.0209984368048026,-3.044831018955165,-3.044831018955165&400,400,400,400,400,400,2000,400,600,400&routeName=testTask">Click
        Here</a>

    <?php
    die();
}

/**
 * requiring all the classes etc
 */
//you need to change this so it points to the right folder
$pathToXcTrackSrc = __DIR__ . '/../src';
require($pathToXcTrackSrc . '/Traits/JsonSerializable.php');
require($pathToXcTrackSrc . '/Exception.php');
require($pathToXcTrackSrc . '/Factory.php');
require($pathToXcTrackSrc . '/Goal.php');
require($pathToXcTrackSrc . '/StartSpeedSection.php');
require($pathToXcTrackSrc . '/Task.php');
require($pathToXcTrackSrc . '/Turnpoint.php');
require($pathToXcTrackSrc . '/Waypoint.php');

//import the Factory
use EdmondsCommerce\XcTrack\Factory;

//use the factory to create the task from the $_GET super global
$task = Factory::createTaskFromGet();

//get the json string
$json = $task->toJson();

//get a clean task name
$taskName = preg_replace('%[^a-z0-9]%i', '', $_GET[Factory::GET_PARAM_TASK_NAME] ?: 'task');

//output the json as a download
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
header("Content-type: application/txt");
header('Content-Length: ' . strlen($json));
header("Content-Disposition: attachment; filename=$taskName.xctsk");
header("Content-Transfer-Encoding: binary");
echo $json;

