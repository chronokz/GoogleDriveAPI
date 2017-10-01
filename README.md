# GoogleDriveAPI
Google Drive Server API (no need OAuth2 and cURL)

**How it was born:**<br>
This script for easy work with Google Drive.<br>
Because Google code and examples are terrible?<br>
Many people recommended use cURL and etc like a solution for OAuth2 authorize<br>
also sometimes I faced solution with only once OAuth and next work with *setAccessType('offline')*.<br>
Yes, it is works... but I do not find the solutions are comfortable. Sorry all for my opinion ;)<br>

**Before start (by the way, I think you already did everything except the last):**

 1. Create project in api google console
 2. Allow your project use lib Google Drive API.
 2. Make account service key and save it (It will be your secret.json)
 3. Install google client ``php composer.phar require google/apiclient:^2.0``
 4. Create a folder in your Google Drive and give access the service account \*\*\*\*@\*\*\*\*.iam.gserviceaccount.com (genereated in your previously step).

**You must know:**<br>
In Google Drive your folders and files saved under ID,<br>
it is mean you can keep many files and folder with equals names.<br>
I.e. you can make 'test.txt' even already exist,<br>
...and than you make another 'test.txt',<br>
......and again to infinity,<br>
.........and live with are until delete.

**How it use:**
```php
    include_once 'google-drive-api.php'; // Include the script
    $drive = new GoogleDriveAPI();
    $drive->init();
    
    $drive->getFolderId('SomeFolder'); // Get Folder ID
    $drive->getFiles('FileName.txt'); // Find Files with this name
    
    $drive->deleteFiles('FileName.txt'); // Delete All FileName.txt from drive
    $drive->deleteFiles('FileName.txt', 'FolderID'); // Delete FileName.txt from folder
    
    $drive->uploadFile('FileName.txt' [, $folderId=false [, $rewrite = true]]);
    // Upload file to (optional)$folderId and (optional)$rewrite file with equals name.
```
**In conclusion I will say:**<br>
In skilful hands it can be more than file editor at Google Drive.<br>
It can work with [all services of Google](https://developers.google.com/products/ "all services of Google"). <br>
And It can be work for Java, Phyton, ~~php~~, .Net, Ruby, Node.js, Objective-C.<br>
So, all the best and good luck, and do not forget to work harder.<br>
