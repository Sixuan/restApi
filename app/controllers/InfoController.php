<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/11/15
 * Time: 10:17 PM
 */

namespace app\controllers;


class InfoController extends BaseController{

    public function get() {
        echo 'get';
    }

    public function store() {
        echo 'post';
    }

    public function remove() {
        echo 'delete';
    }

    public function update() {
        echo 'put';
    }

}