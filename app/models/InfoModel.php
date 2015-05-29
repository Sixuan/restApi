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
        $this->getSql()->insert ('VISIT_COUNT', $insert);

        if(sizeof($heat_map)){
            foreach($heat_map as $h){
                $this->getSql()->insert ('HEAT_MAP_DATA',
                    array(
                        'DEVICE_ID' => $data->device_id,
                        'POSITION_X'    => $h->x,
                        'POSITION_Y'    => $h->y,
                        'POSITION_VALUE'    => $h->v,
                    )
                );
            }
        }

        return true;

    }



}