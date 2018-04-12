<?php namespace App\Services;

use Google_Client;

class SpreadSheet
{
    protected $id = '15GFdGwo8eXh7luXWLcILh90kcGmTPsbJaMiI1VahTrI';

    protected $service;
    protected static $client;

    public function __construct()
    {
        if(!self::$client)
            self::setGoogleClient();

        $this->service = new \Google_Service_Sheets(self::$client);
    }

    public function add(array $item): bool { // add an array of data to the google sheet
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];

        $body = new \Google_Service_Sheets_ValueRange([
            'values' => [
                $item
            ]
        ]);

        $result = $this->getService()->spreadsheets_values->append($this->id, "A2", $body, $params);

        return !!$result->getUpdates()->getUpdatedCells(); // status
    }

    /**
     * Sets the authorized API client.
     * @throws \Google_Exception
     */
    public static function setGoogleClient() {

        $client = new Google_Client();
        $client->setApplicationName(APP_NAME);
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);

        $client->setAccessType('offline');
        $client->setAuthConfig(GOOGLE_CREDENTIALS_PATH);
        self::$client = $client;
    }

    protected function getService(): \Google_Service_Sheets {
        return $this->service;
    }

}
