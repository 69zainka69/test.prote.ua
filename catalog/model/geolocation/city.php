<?php

class ModelGeolocationCity extends Model
{

    public function closestCities($coords, $googleResults)
    {
        $coords = explode(',', $coords);
        $sql = $this->db->query("SELECT *, ( 6371 * acos( cos( radians(" . $coords[0] . ") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(" . $coords[1] . ") ) + sin( radians(" . $coords[0] . ") ) * sin( radians( latitude ) ) ) ) AS distance FROM citys HAVING distance < 20 ORDER BY distance ASC");
        return $sql;
    }
}
