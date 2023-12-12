<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PokeApi
{
    private static function getBaseRequest(): PendingRequest
    {
        return Http::baseUrl('https://pokeapi.co/api/v2/')
            ->retry(2, 500)
            ->throw();
    }

    private static function buildStorage(string $entity): void
    {
        $entities = collect();

        for ($i = 1; $i < 18; $i++) {
            $response = self::getBaseRequest()
                ->get("$entity/$i");

            $entities->push($response->json());
            sleep(1);
        }

        Storage::put("$entity.json", $entities->toJson());
    }

    public static function getMultiple(string $entity): array
    {
        if (!Storage::has("$entity.json")) {
            self::buildStorage($entity);
        }

        return Storage::json("$entity.json")
            ?? throw new \Exception('failed to retrieve cached entity');
    }
}
