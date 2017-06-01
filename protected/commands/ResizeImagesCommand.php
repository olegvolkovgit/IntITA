<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 01.06.2017
 * Time: 12:29
 * Class for resize images from console
 */
class ResizeImagesCommand extends CConsoleCommand
{
    /**
     * Resize image using GD
     * @param string $path - path to directory with images
     * @param string $maxSizeInPixel - Max image height and width
     * @param int $quality - quality
     */
    public function actionResize($path, $maxSizeInPixel, $quality){
        if (!file_exists($path.'/original')){
            mkdir($path.'/original');
        }
        $resizer = new ImageResizer($maxSizeInPixel);
        $iterator = new FilesystemIterator($path);
        foreach ($iterator as $file){
            if ($file->isFile()){
                copy($path.'/'.$file->getFilename(),$path.'/original/'.$file->getFilename());
                $resizer->resizeImage($path.'/'.$file->getFilename(),$quality);
            }
        }
    }
    /**
     * Resize image using ImageMagick
     * @param string $path - path to directory with images
     * @param string $maxSizeInPixel - Max image height and width
     * @param int $quality - quality
     */
    public function actionResizeIM($path, $maxSizeInPixel, $quality ){
        if (!file_exists($path.'/original')){
            mkdir($path.'/original');
        }
        $iterator = new FilesystemIterator($path);
        foreach ($iterator as $file){
            if ($file->isFile()){
                copy($file->getPathname(),$path.'/original/'.$file->getFilename());
                $image = new Imagick($file->getPathname());
                if ($image->getImageWidth() > $maxSizeInPixel || $image->getImageHeight() > $maxSizeInPixel) {

                    if ($image->getImageWidth() > $image->getImageHeight()) {
                        $image->setImageCompressionQuality($quality);
                        $image->thumbnailImage($maxSizeInPixel, 0);
                    } else {
                        $image->thumbnailImage(0, $maxSizeInPixel);
                    }
                    $image->writeImage();
                }
            }
        }

    }
}
