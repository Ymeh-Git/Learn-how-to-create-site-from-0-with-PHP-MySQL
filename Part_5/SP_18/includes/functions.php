<?php
require_once('db.php');

function uploadFile($file) {

    $dossierStockage = dirname(__DIR__) . '/assets/uploads/'; // Final file path

    // IF /assets/uploads doesn't exist, then create it
    if(!is_dir('assets/uploads')){
        mkdir('assets/uploads', 0755, true); // (directory, permissions, recursive)
    }

    $size = 2 * 1024 * 1024; // 2 Mo en octets
    
    // Allowed Extensions Whitelist)
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf'];
    
    // Types MIME allowed
    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf'];

    // 2. Let's hope for no error
    if ($file['error'] !== 0) {
        return [
            'success' => false,
            'error' => "Transfer error (Code: " . $file['error'] . ")"
        ];
    }

    // 3. Check size
    if ($file['size'] > $size) {
        return [
            'success' => false,
            'error' => "The file is above limit (Max 2Mo)."
        ];
    }

    // 4. Check extensions and type MIME
    // pathinfo(path, flags);
    // flags specify returned extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // check if $extension is in $allowedExtensions
    if (!in_array($extension, $allowedExtensions)) {
        return [
            'success' => false,
            'error' => "Only JPG, PNG, GIF, PDF and WEBP are allowed."
        ];
    }

    // Deny .ext changes
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file['tmp_name']);

    if (!in_array($mimeType, $allowedMimes)) {
        return [
            'success' => false,
            'error' => "File corrupted or it is not a valid image."
        ];
    }

    // 5. Clearing and rename it
    $newName = uniqid('img_', true) . '.' . $extension;
    
    // Final complete path
    $finalFilePath = $dossierStockage . $newName;

    // 6. Final shift
    // move_uploaded_file check if it's an uploaded file and then shift it
    if (move_uploaded_file($file['tmp_name'], $finalFilePath)) {
        // Success, return filename or path for DB
        return [
            'success' => true,
            'filename' => $newName,
            'path' => $finalFilePath
        ];
    } else {
        return [
            'success' => false,
            'error' => "Error while saving file."
        ];
    }
}

function addMail($mail, $content, $filename = null){
    $pdo = getPDO();

    $sql = "INSERT INTO mails(mail, content, filename) 
            VALUES(:mail, :content, :filename)";

    $stmt = $pdo->prepare($sql);

    $stmt->BindValue(':mail', $mail, PDO::PARAM_STR);
    $stmt->BindValue(':content', $content, PDO::PARAM_STR);
    if($filename){
        $stmt->BindValue(':filename', $filename, PDO::PARAM_STR);
    } else{
        $stmt->BindValue(':filename', NULL, PDO::PARAM_NULL);
    }

    return $stmt->execute();
}

function getMails(){
    $pdo = getPDO();

    $sql = "SELECT * FROM mails";
    $query = $pdo->query($sql);

    $mails = $query->fetchAll(PDO::FETCH_ASSOC);

    return $mails;
}