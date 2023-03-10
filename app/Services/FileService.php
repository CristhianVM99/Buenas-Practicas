<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class FileService
{
    const LOCAL         = 'local';
    const PUBLIC        = 'public';
    const IMAGENES_EXT  = array("jpg", "jpeg", "png", "gif", "tif", "tiff", "bmp", "raw", "dng", "svg");

    public static function storeFile(?UploadedFile $file, $path, $name = null)
    {
        if (!$file) return null;

        $fileName = is_null($name)? $file->getClientOriginalName() : $name.".".$file->extension();
        $disk = self::getDiskByExtension($fileName);
        return $file->storeAs($path, $fileName, $disk);
    }

    public static function getName(?UploadedFile $file)
    {
        return $file->getClientOriginalName();
    }
    
    public static function exists( $fileName = null)
    {
        return $fileName? Storage::disk( self::getDiskByExtension($fileName) )->exists( $fileName ): false;
    }

    public static function getUrl( $fileName = null)
    {
        if(self::exists( $fileName ))
        {
            if(self::getDiskByExtension( $fileName ) == self::PUBLIC)
            {
                return public_path('storage/'.$fileName);
            }
            return storage_path('app/'.$fileName);
        }
        return null;
    }

    public static function delete( $urlFile)
    {
        return self::exists($urlFile)? Storage::disk(self::getDiskByExtension($urlFile))->delete($urlFile) : null;
    }

    private static function getDiskByExtension( $filename)
    {
        if( in_array( File::extension($filename), self::IMAGENES_EXT ) )
        {
            return self::PUBLIC;
        }
        return self::LOCAL;
    }

}