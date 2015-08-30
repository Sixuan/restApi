<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/17/15
 * Time: 4:32 PM
 */

namespace app\models;


use lib\ApiException;

class InfoModel extends BaseModel{

    public function storeDeviceScene($json_data) {

        $data = json_decode($json_data);
        $post = $_POST;

        if(!isset($post['device_id'])){
            throw new ApiException('Device id is not defined.', array('data' => $post));
        }

        $device_id = $post['device_id'];
        if($_FILES["picture"]["error"] == UPLOAD_ERR_OK){
            $tmp_name = $_FILES["picture"]["tmp_name"];
            $path_info = $this->pathinfo_im($_FILES["picture"]["name"]);
            $extension = $path_info['extension'];
            $destination = "/var/www/wikkitImages/deviceScene/device_".$device_id."_".time()."_.".$extension;
            move_uploaded_file($tmp_name, $destination);
            $db = $this->getSql();
            $update = $db->where('DEVICE_ID', $device_id)->update('DEVICE', array('SCENE_IMG' => $destination));
            return $update;
        }

        return false;
    }

    private function pathinfo_im($path) {

        $tab = pathinfo($path);

        $tab["basenameWE"] = substr($tab["basename"],0
            ,strlen($tab["basename"]) - (strlen($tab["extension"]) + 1) );

        return $tab;
    }

    public function insertCountHeatmap($json_data) {

        $data = json_decode($json_data);

        if(!isset($data->device_id)){
            throw new ApiException('Device id is not defined.', array('data' => $json_data));
        }

        if($data->timestamp) {
            $time = date('Y-m-d H:i:s', $data->timestamp);
        }else{
            $time = date('Y-m-d H:i:s', time());
        }

        $insert = Array (
            "DEVICE_ID" => $data->device_id,
            "NUM" => $data->count,
            'TIME_VISITED' => $time
        );

        $heat_map = $data->heat_map;
        $i = $this->getSql()->insert ('VISIT_COUNT', $insert);
        if(sizeof($heat_map)){
            foreach($heat_map as $h){
                $i = $this->getSql()->insert ('HEAT_MAP_DATA',
                    array(
                        'DEVICE_ID' => $data->device_id,
                        'POSITION_X'    => $h->x,
                        'POSITION_Y'    => $h->y,
                        'POSITION_VALUE'    => $h->v,
                        'TIME_CREATED' => $time
                    )
                );
            }
        }

        return $i;

    }

    public function getHeatMap($company_id, $timestamp) {
        $time = date('Y-m-d H:i:s', $timestamp);
        $apiConfig = $this->getApiConfig();
        $time_one_hour_ago = date('Y-m-d H:i:s', ($timestamp - $apiConfig['heatmap']['threshold']));
        $query = "SELECT
                            SUM(VT.NUM) AS 'TOTAL_COUNT',
                            VT.DEVICE_ID
                            FROM VISIT_COUNT VT
                            JOIN DEVICE D ON (VT.DEVICE_ID = D.DEVICE_ID)
                            WHERE D.COMPANY_ID = ".(int)$company_id."
                            AND TIME_VISITED BETWEEN '".$time_one_hour_ago."' AND '".$time."' GROUP BY VT.DEVICE_ID";

        $db = $this->getSql();

        $heat_map = $db->rawQuery($query);

        return $heat_map;
    }

    public function getHeatMapForDevice($company_id, $timestamp, $device_id) {
        $time = date('Y-m-d H:i:s', $timestamp);
        $apiConfig = $this->getApiConfig();
        $time_one_hour_ago = date('Y-m-d H:i:s', ($timestamp - $apiConfig['heatmap']['threshold']));
        $query = "SELECT
                            POSITION_X,
                            POSITION_Y,
                            POSITION_VALUE,
                            H.TIME_CREATED,
                            H.DEVICE_ID
                            FROM HEAT_MAP_DATA H
                            JOIN DEVICE D ON (H.DEVICE_ID = D.DEVICE_ID)
                            WHERE D.COMPANY_ID = ".(int)$company_id."
                            AND TIME_CREATED BETWEEN '".$time_one_hour_ago."'
                            AND '".$time."'
                            AND H.ACTIVE = 'Y'
                            AND H.DEVICE_ID =".(int)$device_id;

        $db = $this->getSql();

        $heat_map = $db->rawQuery($query);

        return $heat_map;

    }

    public function getVisitCount($company_id, $type) {

        switch($type){
            case 'week':
                if(date('D', time()) == 'Sun'){
                    $last = strtotime("last Monday") - 7 * 24 * 60 * 60;
                    $last_monday = date('Y-m-d', $last);
                }else{
                    $last_monday = date('Y-m-d', strtotime("last Monday"));
                }
                $query = "SELECT SUM(VT.NUM) AS 'TOTAL_COUNT',
                            DATE(VT.TIME_VISITED) AS 'DATE_TIME'
                            FROM VISIT_COUNT VT
                            JOIN DEVICE D ON (VT.DEVICE_ID = D.DEVICE_ID)
                            WHERE D.COMPANY_ID = ".(int)$company_id."
                            AND TIME_VISITED BETWEEN '".$last_monday." 00:00:00' AND NOW() GROUP BY DATE(TIME_VISITED)";

                break;
            case 'month':
                $first_day_of_last_month = date('Y-m-d', strtotime("first day of last month"));
                $query = "SELECT SUM(VT.NUM) AS 'TOTAL_COUNT',
                            DATE(VT.TIME_VISITED) AS 'DATE_TIME'
                            FROM VISIT_COUNT VT
                            JOIN DEVICE D ON (VT.DEVICE_ID = D.DEVICE_ID)
                            WHERE D.COMPANY_ID = ".(int)$company_id."
                            AND TIME_VISITED BETWEEN '".$first_day_of_last_month." 00:00:00' AND NOW() GROUP BY DATE(TIME_VISITED)";

                break;
            case 'day':
            default:
                $yesterday = date('Y-m-d', strtotime("now") - 24*60*60);
                $query = "SELECT SUM(VT.NUM) AS 'TOTAL_COUNT',
                            HOUR(VT.TIME_VISITED) AS 'HOUR_TIME',
                            DATE(VT.TIME_VISITED) AS 'DATE_TIME'
                            FROM VISIT_COUNT VT
                            JOIN DEVICE D ON (VT.DEVICE_ID = D.DEVICE_ID)
                            WHERE D.COMPANY_ID = ".(int)$company_id."
                            AND TIME_VISITED BETWEEN '".$yesterday." 00:00:00' AND NOW() GROUP BY DATE(TIME_VISITED), HOUR(TIME_VISITED)";
                break;
        }

        //print $query;
        $db = $this->getSql();

        $users = $db->rawQuery($query);

        return $users;
    }



}