<?php

function uploadImage($fileInputName, $target_dir = "images/")
{
    // Check if file is uploaded
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Get the original file name
    $ori_image = basename($_FILES[$fileInputName]["name"]);

    // Get the file extension from the original file name
    $imageFileType = strtolower(pathinfo($ori_image, PATHINFO_EXTENSION));

    // Generate a unique file name using timestamp and random string
    $timestamp = time();
    $newFileName = $target_dir . $timestamp . "_" . bin2hex(random_bytes(2)) . '.' . $imageFileType;

    // Check if file is an actual image
    $check = getimagesize($_FILES[$fileInputName]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        return false;
    }

    // Check file size (max size 2MB)
    if ($_FILES[$fileInputName]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        return false;
    }

    // Allow only certain file formats
    $allowedExtensions = ["jpg", "jpeg", "png", "gif", "webp"];
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
        return false;
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $newFileName)) {
        return $newFileName;  // Return file path if upload is successful
    } else {
        echo "Sorry, there was an error uploading your file.";
        return false;
    }
}

?>