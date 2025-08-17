<?php
namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Drive;
use Exception;


class PdfController extends Controller
{
     public function index(GoogleDriveService $drive)
    {
        $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
        $pdfNames = $drive->listPdfFileNames($folderId);

        return view('pdfs.index', compact('pdfNames'));
    } 
   public function index2()
    {
        try {
            // Initialize the client
            $client = new Google_Client();
            $client->setAuthConfig(config('services.google.drive.credentials'));
            $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

            // Create the Drive service
            $drive = new Google_Service_Drive($client);

            // Fetch folder metadata
            $folderId = env('GOOGLE_DRIVE_FOLDER_ID');
            $folder = $drive->files->get($folderId, [
                'fields' => 'id,name,mimeType',
            ]);
            // List just the IDs of items in that folder
            $response = $drive->files->listFiles([
                'q'        => "'{$folderId}' in parents and trashed = false",
                'fields'   => 'nextPageToken, files(id)',
                'pageSize' => 1000,  // bump up if you might have more than 100
            ]);

            // Count how many file objects you got back
            $fileCount = count($response->getFiles());

            $status = "Connected! Folder name: {$folder->getName()} (ID: {$folder->getId()})";
        } catch (Exception $e) {
            $status = "Connection failed: " . $e->getMessage();
            $fileCount =0;
        }

        return view('pdfs.index', compact('status','fileCount'));
    }

}
