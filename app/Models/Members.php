<?php

namespace App\Models;

use GuzzleHttp\Client;


class Members
{

    public static function listMembers($id, $page)
    {
        try {
            $companyURL = "https://e.truckyapp.com/api/v1/company/" . $id . "/members";
            if ($page) {
                $companyURL = "https://e.truckyapp.com/api/v1/company/" . $id . "/members?page=" . $page;
            }

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

    public static function showMember($id)
    {
        try {
            $memberURl = "https://e.truckyapp.com/api/v1/user/" . $id;

            $client = new Client();
            $response = $client->get($memberURl, [
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

    public static function memberJobs($id, $page)
    {
        try {
            $memberURl = "https://e.truckyapp.com/api/v1/user/" . $id . "/jobs";
            if ($page) {
                $memberURl = "https://e.truckyapp.com/api/v1/user/" . $id . "/jobs?page=" . $page;
            }

            $client = new Client();
            $response = $client->get($memberURl, [
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

    public static function memberJob($id)
    {
        try {
            $jobURL = "https://e.truckyapp.com/api/v1/job/" . $id;

            $client = new Client();
            $response = $client->get($jobURL, [
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

    public static function jobIcons($jobCargo, $typeCargo)
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
}
