<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 8/22/15
 * Time: 12:32 AM
 */

namespace app\models;


class ApiConfig {

    private static $api = array(
        'heatmap' => array(
            'threshold' => 604800 //7 days
        ),
    );


    final public static function getApiConfig() {
        return self::$api;
    }
}