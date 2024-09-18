<?php

namespace Zmap95\VietnamMap;

use GuzzleHttp\Client;

class DownloadFile
{
    const FILE_URL = 'https://github.com/zmap95/vietnam-maps/raw/vietnam-maps/vietnam-maps.xls';

    public function saveFile()
    {
        $client = new Client([
            'verify' => false
        ]);

        $res = $client->request('GET', self::FILE_URL, [
            'sink' => storage_path('vietnam-maps.xls')
        ]);

        return $res->getStatusCode() == 200 ? storage_path('vietnam-maps.xls') : null;
    }
}
