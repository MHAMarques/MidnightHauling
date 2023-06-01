<?php

namespace App\Models;

use GuzzleHttp\Client;


class Company
{
    public static function listCompanies($companySearch)
    { {
            $companyURL = "https://e.truckyapp.com/api/v1/companies?name=" . $companySearch;
            $client = new Client();
            $response = $client->get($companyURL, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36',
                ],
            ]);
            $data = json_decode($response->getBody(), true);

            if (!empty($data)) {
                return $data['data'];
            } else {
                // Handle the case where the data is empty or null
                return null; // Or you can throw an exception or return a default value
            }
        }
    }


    public static function getCompany($id)
    { {
            $companyURL = "https://e.truckyapp.com/api/v1/company/" . $id;
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
