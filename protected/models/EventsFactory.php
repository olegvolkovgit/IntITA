<?php


class EventsFactory
{

	public  function trackEvent($string)
	{

        switch($string) {
            case 'Start_Video':
				return new TrackVideoModel();
            case 'LogIn':
                return new TrackLogInModel();
            case 'LogOut':
                return new TrackLogOutModel();
            case 'Open_Quiz':
                return new TrackOpenQuizModel();
            case 'Open_Text':
                return new TrackOpenTextModel();
            case 'TrueAnswer':
                return new TrackTrueQuizModel();
            case 'FalseAnswer':
                return new TrackFalseQuizModel();

    }
	}
}
