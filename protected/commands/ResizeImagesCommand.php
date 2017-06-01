<?php

/**
 * Created by PhpStorm.
 * User: adm
 * Date: 01.06.2017
 * Time: 12:29
 */
class ResizeAvatarCommand extends CConsoleCommand
{
    public function actionResizeavatars($path){
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