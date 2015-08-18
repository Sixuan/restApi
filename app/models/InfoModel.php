<?php
/**
 * Created by PhpStorm.
 * User: sixuan
 * Date: 5/17/15
 * Time: 4:32 PM
 */

namespace app\models;


class InfoModel extends BaseModel{


    public function insertCountHeatmap($data) {

        $data = json_decode($data);

        $insert = Array (
            "DEVICE_ID" => $data->device_id,
            "NUM" => $data->count,
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
                    )
                );
            }
        }

        return $i;

    }

    public function getVisitCount($company_id, $type) {

        switch($type){
            case 'week':
                $last_monday = date('Y-m-d', strtotime("last Monday"));
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
                            AND TIME_VISITED BETWEEN '".$yesterday." 00:00:00' AND NOW() GROUP BY DATE(TIME_VISITED)";
                break;
        }

        //print $query;
        $db = $this->getSql();

        $users = $db->rawQuery($query);

        return $users;
    }



}