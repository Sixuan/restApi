<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/10/15
 * Time: 9:30 PM
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