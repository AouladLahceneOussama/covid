<?php

namespace App\Database;

use App\Utilities\Connection;

class DB
{
    private $connection;
    private $collections = ['data', 'regions', 'cities'];

    public function __construct()
    {
        $this->connection = (new Connection())->connection();
    }

    public function create(): void
    {
        echo "Creating collections...\n";

        $existingCollections = iterator_to_array($this->connection->listCollectionNames());

        foreach ($this->collections as $collection) {
            if (in_array($collection, $existingCollections)) continue;
            $this->connection->createCollection($collection);
        }

        echo "Done!";
    }

    public function load(): void
    {
        echo "Loading data...\n";

        foreach ($this->collections as $collection) {
            $items = $this->fetchData($_ENV["API_BASE_URL"] . $collection . ".json");

            match ($collection) {
                'data' => $this->fillDataCollection($items),
                'regions' => $this->fillRegionsCollection($items),
                'cities' => $this->fillCitiesCollection($items),
            };
        }

        echo "Done!";
    }

    private function fetchData(string $url): array
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        if ($httpCode != 200 || !$response) return [];

        return json_decode($response, true);
    }

    private function fillDataCollection(array $items): void
    {
        echo "Filling data collection...\n";

        if ($this->connection->data->countDocuments() == 0) {
            $this->connection->data->insertMany($items);
            return;
        }

        $currentDate = date('d/m/Y');
        $items = array_filter($items, fn ($item) => $item['date'] == $currentDate);

        $this->connection->data->updateMany(
            ['date' => $currentDate],
            ['$set' => ['date' => $currentDate, 'data' => $items]]
        );
    }

    private function fillRegionsCollection(array $items): void
    {
        echo "Filling regions collection...\n";

        if ($this->connection->regions->countDocuments() == 0) {
            $this->connection->regions->insertMany($items);
            return;
        }

        $currentDate = date('d/m/Y');
        $this->connection->regions->updateMany(
            ['data' => ['$elemMatch' => ['date' => $currentDate]]],
            ['$set' => ['data.$[elem].new_cases' => 0, 'data.$[elem].death' => 0]],
            ['arrayFilters' => [['elem.date' => $currentDate]]]
        );
    }

    private function fillCitiesCollection(array $items): void
    {
        echo "Filling cities collection...\n";

        if ($this->connection->cities->countDocuments() == 0) {
            $this->connection->cities->insertMany($items);
            return;
        }

        $currentDate = date('d/m/Y');
        $this->connection->cities->updateMany(
            ['data' => ['$elemMatch' => ['date' => $currentDate]]],
            ['$set' => ['data.$[elem].new_cases' => 0, 'data.$[elem].death' => 0]],
            ['arrayFilters' => [['elem.date' => $currentDate]]]
        );
    }
}
