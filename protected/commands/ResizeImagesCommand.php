<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 01.06.2017
 * Time: 12:29
 */
class ResizeImagesCommand extends CConsoleCommand
{
    public function actionResize($path){
        if (!file_exists($path.'/original')){
            mkdir($path.'/original');
        }
        $resizer = new ImageResizer(200);
        $iterator = new FilesystemIterator($path);
        foreach ($iterator as $file){
            if ($file->isFile()){
                copy($path.'/'.$file->getFilename(),$path.'/original/'.$file->getFilename());
                $resizer->resizeImage($path.'/'.$file->getFilename(),70);
            }
        }
    }
}