<?php

use Google_Client as GoogleClient;
use Google_Service_Drive as GoogleDrive;
use Google_Service_Drive_DriveFile as GoogleDriveFile;

class GoogleDriveAPI {

	public $secret = 'secret.json';
	public $redirect = 'http://example.com';

	private $scope =  "https://www.googleapis.com/auth/drive";

	protected $client;
	protected $service;

	public function setSecret($secret) {
		$this->secret = $secret;
	}

	public function setRedirect($redirect) {
		$this->redirect = $redirect;
	}

	public function init() {
		$this->redirect = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$this->client = new GoogleClient();
		$this->client->setAuthConfig(__DIR__.'/'.$this->secret);
		$this->client->addScope($this->scope);
		$this->service = new GoogleDrive($this->client);
	}

	public function getFolderId($folder_name) {
		$response = $this->service->files->listFiles([
		    'q' => "mimeType='application/vnd.google-apps.folder' and name='".$folder_name."'",
		    'fields' => 'files(id, name)',
		]);

		if ($response->files)
			return $response->files[0]->id;

		return false;
	}

	public function getFiles($file_name) {
		$query = "name='$file_name'";
		$response = $this->service->files->listFiles([
			'q' => $query,
			'fields' => 'files(id, name, parents)'
		]);

		return $response->files;
	}

	public function deleteFiles($file_name, $folder_id = false) {
		$files = $this->getFiles($file_name);

		$deleted = [];
		foreach($files as $file) {

			if($folder_id) {
				if(in_array($folder_id, $file->parents)) {
					$this->service->files->delete($file->id);
					$deleted[] = $file->id;
				}
			}
			else {
				$this->service->files->delete($file->id);
				$deleted[] = $file->id;
			}

		}

		return $deleted;
	}

	public function deleteFileById($file_id) {
		$this->service->files->delete($file_id);
	}

	public function uploadFile($file, $folder_id = false, $rewrite = true) {
		$file_name = basename($file);
		$file_mime = mime_content_type($file);
		$file_content = file_get_contents($file);

		if ($rewrite)
			$this->deleteFiles($file_name, $folder_id);

		$upload_file = ['name' => $file_name];
		if ($folder_id)
			$upload_file['parents'] = [$folder_id];

		$drive_file = new GoogleDriveFile($upload_file);
		$result = $this->service->files->create(
			$drive_file,
			[
				'data' => $file_content,
				'mimeType' => $file_mime,
				'uploadType' => 'media'
			]
		);

		return [
			'id' => $result->id,
			'name' => $result->name
		];
	}

}
