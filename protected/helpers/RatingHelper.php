<?php

class RatingHelper {

    public static function getRating($rat){
        $rating='';
        for ($i=0; $i<floor($rat/2); $i++) {
            $rating=$rating."<img src=".StaticFilesHelper::createPath('image', 'common', 'starFull.png').">";
        }
        if($rat/2-floor($rat/2)==0.5) {
            $rating=$rating."<img src=".StaticFilesHelper::createPath('image', 'common', 'star-half.png').">";
        }
        for ($i=ceil($rat/2); $i<5; $i++) {
            $rating=$rating."<img src=".StaticFilesHelper::createPath('image', 'common', 'starEmpty.png').">";
        }
        return $rating;
    }
}