<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsController extends Controller
{
    public function fetchData()
    {
        $client = new Client();
        $client->setApplicationName('Laravel Google Sheets');
        $client->setDeveloperKey(env('GOOGLE_API_KEY')); // Tambahkan API Key di .env

        $service = new Sheets($client);
        $spreadsheetId = '10oD1E2PCXxhcfNqHAoJybdWNDO31vGAy6zk29FmnFww'; // Masukkan ID Google Sheets Anda
        $range = 'Sheet1!A1:N25'; // Atur range sesuai kebutuhan

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();

        return view('task-log', compact('values'));
    }
}
