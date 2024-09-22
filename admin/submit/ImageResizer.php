<?php

class ImageResizer
{
    public $imageFile;
    public $savePath;
    public $maintainAspectRatio = true;

    public function __construct($imageFile)
    {
        $this->imageFile = $imageFile;
    }

    public function resize($trailing_name = null, $resizedWidth = null, $resizedHeight = null)
    {
        $imgTemp = $this->imageFile['tmp_name'];
        $sourceProperties = getimagesize($imgTemp);
        $fileExt = pathinfo($this->imageFile['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        if ($this->maintainAspectRatio) {
            $resizedHeight = $resizedHeight ?: ceil($sourceImageHeight * ($resizedWidth / $sourceImageWidth));
            $resizedWidth = $resizedWidth ?: ceil($sourceImageWidth * ($resizedHeight / $sourceImageHeight));
        }

        $trailing_name = $trailing_name ? $trailing_name : $resizedWidth . 'x' . $resizedHeight;
        $resizeFileName = pathinfo($this->imageFile['name'], PATHINFO_FILENAME) . '_' . $trailing_name . '.' . $fileExt;


        $imgprocessed = false;

        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($imgTemp);
                $imageLayer = $this->resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $resizedWidth, $resizedHeight);
                $imgprocessed = imagejpeg($imageLayer, $this->savePath . DIRECTORY_SEPARATOR . $resizeFileName);
                break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($imgTemp);
                $imageLayer = $this->resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $resizedWidth, $resizedHeight);
                $imgprocessed = imagegif($imageLayer, $this->savePath . DIRECTORY_SEPARATOR . $resizeFileName);
                break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($imgTemp);
                $imageLayer = $this->resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $resizedWidth, $resizedHeight);
                $imgprocessed = imagepng($imageLayer, $this->savePath . DIRECTORY_SEPARATOR . $resizeFileName);
                break;

            case IMAGETYPE_WEBP:
                $resourceType = imagecreatefromwebp($imgTemp);
                $imageLayer = $this->resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $resizedWidth, $resizedHeight);
                $imgprocessed = imagewebp($imageLayer, $this->savePath . DIRECTORY_SEPARATOR . $resizeFileName);
                break;

            default:
                die('Invalid Image type.');
                break;
        }

        return $imgprocessed;
    }

    private function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
    {
        $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
        imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
        return $imageLayer;
    }
}
