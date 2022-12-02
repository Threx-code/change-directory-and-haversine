<?php

class haversineCoverage
{
    /**
     * @param array $locations
     * @param array $shoppers
     * @return array
     */
    public function calculateDistance(array $locations, array $shoppers)
    {
        $data = $result = [];
        foreach ($shoppers as $shopper) {
            foreach ($locations as $location) {
                $result[$shopper['id']]['shopper_id'] = $shopper['id'];
                $result[$shopper['id']]['coverage'][] = $this->getDistanceBetweenPoints($location['lat'], $location['lng'], $shopper['lat'], $shopper['lng']);
            }
        }
        foreach ($result as $key => $newResult) {
            $data[$key]['shopper_id'] = $newResult['shopper_id'];
            $data[$key]['coverage'] = round(array_sum($newResult['coverage']));
        }
        $data = array_values($data);
        array_multisort(array_column($data, 'coverage'), SORT_DESC, $data);
        return $data;
    }

    /**
     * @param $latitude1
     * @param $longitude1
     * @param $latitude2
     * @param $longitude2
     * @return float|int
     */
    public function getDistanceBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371;
        $newLatitude = deg2rad($latitude2 - $latitude1);
        $newLongitude = deg2rad($longitude2 - $longitude1);
        $sinValue = sin($newLatitude / 2) * sin($newLatitude / 2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($newLongitude / 2) * sin($newLongitude / 2);
        $aSinValue = 2 * asin(sqrt($sinValue));
        return $earthRadius * $aSinValue;
    }

}