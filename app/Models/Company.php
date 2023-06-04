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
                return null;
            }
        }
    }

    public static function getCompany($id)
    {
        try {
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
                return null;
            }
        } catch (\Exception $e) {
            echo '<script>
                localStorage.removeItem("MHCompanyId");
                window.location.replace("/");
            </script>';
        }
    }

    public static function getETSMarket()
    { {
            $marketURL = "https://e.truckyapp.com/api/v1/economy/market/1";
            $client = new Client();
            $response = $client->get($marketURL, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36',
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            if (!empty($data)) {
                return $data;
            } else {
                return null;
            }
        }
    }

    public static function getATSMarket()
    { {
            $marketURL = "https://e.truckyapp.com/api/v1/economy/market/2";
            $client = new Client();
            $response = $client->get($marketURL, [
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36',
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            if (!empty($data)) {
                return $data;
            } else {
                return null;
            }
        }
    }
}
