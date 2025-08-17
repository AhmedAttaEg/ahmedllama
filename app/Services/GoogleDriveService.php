<?php
namespace App\Services;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFileList;

class GoogleDriveService
{
    protected Google_Service_Drive $drive;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig(base_path(env('GOOGLE_DRIVE_CREDENTIALS')));
        $client->addScope(Google_Service_Drive::DRIVE_READONLY);

        $this->drive = new Google_Service_Drive($client);
    }

    /**
     * List PDF file names in a given Drive folder
     *
     * @param string $folderId
     * @return array<int, string>
     */
    public function listPdfFileNames(string $folderId): array
    {
        $query = sprintf(
            "'%s' in parents and mimeType='application/pdf' and trashed=false",
            $folderId
        );
        

         $params = [
        'q'        => $query,
        'fields' => 'files(name)'
    ];

        /** @var Google_Service_Drive_DriveFileList $results */
        /* $results = $this->drive->files->listFiles($params); */

        
         $results = $this->drive->files->listFiles([
            'q' => "'root' in parents and trashed = false"
        ]); 
        $files = $results->getFiles();

        return array_map(
            fn($file) => $file->getName(),
            $results->getFiles()
        );  

    }
}
