<?php

namespace App\Models;

use GuzzleHttp\Client;


class Company
{
    public static function listCompanies()
    {
        return [
            [
                'id' => 1,
                'title' => 'Tranformadores TK9000',
                'origem' => 'Frankfurt',
                'destino' => 'Amsterdam'
            ],
            [
                'id' => 2,
                'title' => 'Ponte de Malmo',
                'origem' => 'Amsterdam',
                'destino' => 'Malmo'
            ]
        ];
    }

    public static function pickCompany($id)
    {
        $cards = self::listCompanies();

        foreach ($cards as $card) {
            if ($card['id'] == $id) {
                return $card;
            }
        }
    }

    public static function getCompanyAPI()
    { {
            $companyURL = "https://e.truckyapp.com/api/v1/company/11080";
            $client = new Client();
            $response = $client->get($companyURL, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36',
                ],
            ]);
            $data = json_decode($response->getBody(), true);

            if (!empty($data)) {
                return $data;
            } else {
                // Handle the case where the data is empty or null
                return null; // Or you can throw an exception or return a default value
            }
        }
    }
}
