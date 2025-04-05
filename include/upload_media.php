<?php
function uploadMedia($fileInputName, $target_dir = "uploads/")
{
    // Check if file is uploaded
    if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Get the original file name & extension
    $ori_filename = basename($_FILES[$fileInputName]["name"]);
    $fileExtension = strtolower(pathinfo($ori_filename, PATHINFO_EXTENSION));

    // Generate a unique file name
    $timestamp = time();
    $newFileName = $target_dir . $timestamp . "_" . bin2hex(random_bytes(2)) . '.' . $fileExtension;

    // Validate MIME type to check if it's an image or video
    $fileMimeType = mime_content_type($_FILES[$fileInputName]["tmp_name"]);

    // Allowed file formats
    $allowedImages = ["image/jpeg", "image/png", "image/gif", "image/webp"];
    $allowedVideos = ["video/mp4", "video/webm", "video/avi", "video/mpeg"];

    if (in_array($fileMimeType, $allowedImages)) {
        $type = "image";
    } elseif (in_array($fileMimeType, $allowedVideos)) {
        $type = "video";
    } else {
        echo "Invalid file type. Only JPG, PNG, GIF, WEBP for images & MP4, WebM, AVI, MPEG for videos.";
        return false;
    }

    // File size limit (Images: 10MB, Videos: 500MB)
    if (($type === "image" && $_FILES[$fileInputName]["size"] > 100 * 1024 * 1024) ||
        ($type === "video" && $_FILES[$fileInputName]["size"] > 500 * 1024 * 1024)
    ) {
        echo "Sorry, your file is too large.";
        return false;
    }

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $newFileName)) {
        return [
            "file_path" => $newFileName,
            "file_type" => $type // "image" or "video"
        ];
    } else {
        echo "Sorry, there was an error uploading your file.";
        return false;
    }
}
?>