<?php

namespace App\Src;

use App\Utilities\Connection;

class Methods
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new Connection())->connection();
    }

    public function getCityByRegion($regionID)
    {
        $regions = $this->connection->regions;
        $cursor = $regions->find(['region_id' => $regionID]);
        $output = "";
        
        foreach ($cursor as $region) {

            $output = '
                 
                <div
                class="w-full flex flex-col md:flex-row justify-between space-y-4 md:space-x-4 md:space-y-0 mt-8 items-center">
                <div class="w-full bg-gray-800 text-white py-4 px-6 rounded-2xl text-center">
                    <p class="font-bold border-b-2 border-indigo-200 ">Number total of cases</p>
                    <p class="text-gray-300 text-xl pt-4 pl-2">' .  $region['data'][count(($region['data'])) - 1]['new_cases'] . '</p>
                </div>
                <div class="w-full bg-gray-800 text-white py-4 px-6 rounded-2xl text-center">
                    <p class="font-bold border-b-2 border-indigo-200 ">Number total of death</p>
                    <p class="text-gray-300 text-xl pt-4 pl-2">' .  $region['data'][count(($region['data'])) - 1]['death'] . '</p>
                </div>
            </div>
            <div class="shadow overflow-hidden rounded border-b border-gray-200">
                <div class="flex justify-between">
                    <h1 class="text-right my-4 font-semibold">' . $region->region_name . '</h1>
                    <p class="text-right my-4 text-gray-500 text-md">' . $this->Lastdate() . '</p>
                </div>
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Cities</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-24 text-center">Cases</td>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-24 text-center">Deaths</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
            ';

            foreach ($region->villes as $villeID) {
                $citys = $this->connection->villes;
                $cursor2 = $citys->find(['ville_id' => $villeID]);
                foreach ($cursor2 as  $city) {
                    $output .= '
                    <tr class="border-b-2 border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out" >
                        <td class="text-left py-3 px-4">' . $city->ville_name . '</td>
                        <td class="text-left py-3 px-4 text-center">' . $city['data'][count(($city['data'])) - 1]['new_cases'] . '</td>
                        <td class="text-left text-red-300 py-3 px-4 text-center">' . $city['data'][count(($city['data'])) - 1]['death'] . '</td>
                    </tr> ';
                }
            }
            $output .= '
                    </tbody>
                </table>
            </div>
            ';
        }

        echo $output;
    }

    public function Lastdate()
    {
        $data = $this->connection->data;
        $cursor = $data->find();

        foreach ($cursor as $data) {
            $output = $data['date'];
        }

        return $output;
    }

    public function RegionsCases()
    {
        $regions = $this->connection->regions;
        $cursor = $regions->find();
        $output = "";

        foreach ($cursor as $region) {

            $output .= '<tr class="border-b-2 border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                        <td class="text-left py-3 px-4">' . $region->region_name . '</td>
                        <td class="text-left py-3 px-4 text-center">' . $region['data'][count(($region['data'])) - 1]['new_cases'] . '</td>
                        <td class="text-left text-red-300 py-3 px-4 text-center">' . $region['data'][count(($region['data'])) - 1]['death'] . '</td>
                    </tr>';
        }

        echo $output;
    }

    public function allRegionCity()
    {
        $regions = $this->connection->regions;
        $cursor = $regions->find();
        $output = "";

        foreach ($cursor as $region) {

            $output .= '
            <div class="w-full min-h-full">
                 <div class="py-8 w-full">
                    <h1 class="font-semibold text-xl my-2">' . $region->region_name . '</h1>

                    <div class="shadow overflow-hidden rounded border-b border-gray-200">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">City</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-24 text-center"> Cases</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm w-24 text-center"> Deaths</th>

                                </tr>
                            </thead>
                            <tbody class="text-gray-700">';

            foreach ($region->villes as $villeID) {
                $citys = $this->connection->villes;
                $cursor2 = $citys->find(['ville_id' => $villeID]);
                foreach ($cursor2 as  $city) {
                    $output .= '
                                <tr class="border-b-2 border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                    <td class="text-left py-3 px-4">' . $city->ville_name . '</td>
                                    <td class="text-left py-3 px-4 text-center">' . $city['data'][count(($city['data'])) - 1]['new_cases'] . '</td>
                                    <td class="text-left text-red-300 py-3 px-4 text-center">' . $city['data'][count(($city['data'])) - 1]['death'] . '</td>
                                </tr>
                        ';
                }
            }
            $output .= '                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            ';
        }

        echo $output;
    }

    public function globalDataToday()
    {

        $data = $this->connection->data;
        $cursor = $data->find(["date" => $this->Lastdate()]);

        foreach ($cursor as $data) {
            return $data;
        }
    }

    public function chart()
    {

        $data = $this->connection->data;
        $cursor = $data->find([
            'date' => [
                '$gt' => date("d/m/Y", strtotime("-8 days")),
                '$lt' => date("d/m/Y", strtotime("-1 days"))
            ]
        ]);

        $day = [];
        $death = [];
        $recovered = [];
        $confirmed_cases = [];

        foreach ($cursor as $data) {
            array_push($day, $data['date']);
            array_push($death, $data['death']);
            array_push($recovered, $data['recovered']);
            array_push($confirmed_cases, $data['confirmed_cases']);
        }

        return [
            'day' => $day,
            'death' => $death,
            'recovered' => $recovered,
            'confirmed_cases' => $confirmed_cases
        ];
    }

    public function doughnut()
    {

        $regions = $this->connection->regions;
        $cursor = $regions->find();

        $region_name = [];
        $new_cases = [];

        foreach ($cursor as $region) {
            array_push($region_name, $region->region_name);
            array_push($new_cases, $region['data'][count(($region['data'])) - 1]['new_cases']);
        }

        return [
            'label' => $region_name,
            'data' => $new_cases
        ];
    }

    public function getNameByID($regionID)
    {

        $regions = $this->connection->regions;
        $cursor = $regions->find(['region_id' => $regionID]);

        foreach ($cursor as $region) {
            echo $region->region_name .
                '<br> New cases : ' . $region['data'][count(($region['data'])) - 1]['new_cases'] .
                '<br> Death : ' . $region['data'][count(($region['data'])) - 1]['death'];
        }
    }
}
