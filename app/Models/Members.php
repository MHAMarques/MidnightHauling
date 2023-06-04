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
}
