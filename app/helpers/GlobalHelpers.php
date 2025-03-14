

<?php

    if (!function_exists('base64_to_file')) {
        
        function base64_to_file($base64String){
            // return "BASE 64 function";

            preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches);
            $fileExtension = $matches[1] ?? 'png'; // Default to PNG if not found

            // Remove the metadata (data:image/png;base64,)
            $base64Data = preg_replace('/^data:image\/\w+;base64,/', '', $base64String);
            $decodedImage = base64_decode($base64Data);

            // Generate a unique filename
            $fileName = uniqid() . '.' . $fileExtension;

            // Define the storage path (inside storage/app/public/uploads/)
            // $filePath = "uploads/".$fileName;

            // Save the file
            // Storage::disk('public')->put($filePath, $decodedImage);

            // Output the stored file path or URL
            // return response()->json(['file_path' => $filePath, 'file_url' => $fileUrl]);
            return array(
                'decodedImage' => $decodedImage, 
                'fileName' => $fileName
            );
        }

    }