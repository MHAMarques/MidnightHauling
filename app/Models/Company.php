<?php

namespace App\Models;

use GuzzleHttp\Client;


class Company
{
    public static function listCompanies($companySearch)
    {
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
    {
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

    public static function getATSMarket()
    {
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

    public static function getETSRoutes($id)
    {
        $companyURL = "https://e.truckyapp.com/api/v1/company/" . $id . "/jobs?game_id=1&status=completed";
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
    }

    public static function getATSRoutes($id)
    {
        $companyURL = "https://e.truckyapp.com/api/v1/company/" . $id . "/jobs?game_id=2&status=completed";
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
    }

    public static function getCompanyYearStats($id)
    {
        $companyURL = "https://e.truckyapp.com/api/v1/company/" . $id . "/stats/yearly";
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
    }

    public static function allTimeStats($id, $token)
    {
        $companyURL = "https://e.truckyapp.com/api/v1/company/" . $id . "/stats";
        $client = new Client();
        $response = $client->get($companyURL, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36',
                'X-ACCESS-TOKEN' => $token,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        if (!empty($data)) {
            return $data;
        } else {
            return null;
        }
    }

    public static function monthlyStats($id, $token)
    {
        $companyURL = "https://e.truckyapp.com/api/v1/company/" . $id . "/stats/eco/monthly";
        $client = new Client();
        $response = $client->get($companyURL, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.93 Safari/537.36',
                'X-ACCESS-TOKEN' => $token,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        if (!empty($data)) {
            return $data;
        } else {
            return null;
        }
    }

    public static function cargoIcons($jobCargo, $typeCargo)
    {
        $cargoType = "content_paste_search";
        if ($typeCargo == 'refrigerated') {
            $cargoType = "ac_unit";
        } elseif ($jobCargo == 'liquid') {
            $cargoType = "water_drop";
        } elseif ($typeCargo == 'curtainside') {
            $cargoType = "pallet";
        } elseif ($jobCargo == 'containers') {
            $cargoType = "inventory_2";
        } elseif ($jobCargo == 'refrigerated') {
            $cargoType = "ac_unit";
        } elseif ($jobCargo == 'machinery' && $typeCargo == 'lowboy') {
            $cargoType = "plumbing";
        } elseif ($jobCargo == 'machinery') {
            $cargoType = "garage";
        } elseif ($jobCargo == 'construction') {
            $cargoType = "handyman";
        } elseif ($jobCargo == 'bulk') {
            $cargoType = "grain";
        } elseif ($jobCargo == 'inloader') {
            $cargoType = "auto_awesome";
        } elseif ($jobCargo == 'oversize') {
            $cargoType = "swap_driving_apps_wheel";
        } elseif ($typeCargo == 'lowboy') {
            $cargoType = "plumbing";
        }
        return $cargoType;
    }

    public static function setCookieToken($token)
    {
        $cookie = cookie('MHToken', $token, 600); // 60 minutes expiration time
        return response('Cookie set')->withCookie($cookie);
    }
}
