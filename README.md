# GoogleDriveAPI
Google Drive Server API (no need OAuth2 and cURL)

**How it was born:**
This script for easy work with Google Drive.
Because Google code and examples are terrible?
Many people recommended use cURL and etc like a solution for OAuth2 authorize
also sometimes I faced solution with only once OAuth and next work with *setAccessType('offline')*.
Yes, it is works... but I do not find the solutions are comfortable. Sorry all for my opinion ;)

**Before start (by the way, I think you already did first, second and third steps):**

 1. Create project in api google console
 2. Allow your project use lib Google Drive API.
 2. Make account service key and save it (It will be your secret.json)
 3. Create a folder in your Google Drive and give access the service account \*\*\*\*@\*\*\*\*.iam.gserviceaccount.com (genereated in your previously step).

**You must know:**
In Google Drive your folders and files saved under ID, it is mean you can keep many files and folder with equals names. I.e. you can make 'test.txt' if even already exist, and than you make another 'test.txt', and again to infinity, and live with are until delete.

**How it use:**

    include_once 'google-drive-api.php'; // Include the script
    $drive = new GoogleDriveAPI();
    $drive->init();
    
    $drive->getFolderId('SomeFolder'); // Get Folder ID
    $drive->getFiles('FileName.txt'); // Find Files with this name
    
    $drive->deleteFiles('FileName.txt'); // Delete All FileName.txt from drive
    $drive->deleteFiles('FileName.txt', 'FolderID'); // Delete FileName.txt from folder
    
    $drive->uploadFile('FileName.txt' [, $folderId=false [, $rewrite = true]]); // Upload file to (optional)$folderId and (optional)$rewrite file with equals name.

**In conclusion I will say:**
In skilful hands it can be more than file editor at Google Drive. It can work with [all services of Google](https://developers.google.com/products/ "all services of Google"). 
And It can be work for Java, Phyton, ~~php~~, .Net, Ruby, Node.js, Objective-C.
So, all the best and good luck, and do not forget to work harder.
