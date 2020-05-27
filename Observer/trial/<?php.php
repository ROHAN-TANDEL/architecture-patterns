<?php

interface Iyoutube
{
    public function loginYoutube();
    public function logoutYoutube();
    public function notificationOfNewVideo();
}

interface IUser
{
    public function SubscribeToNewVideosNotification();
}

class Youtube implements Iyoutube
{
    public function __construct()
    {
        
    }

    public function loginYoutube()
    {
        
    }

    public function logoutYoutube()
    {
        
    }

    public function notificationOfNewVideo()
    {
        
    }

}

class YoutubeUser implements IUser
{
    public function __construct()
    {
        
    }

    public function SubscribeToNewVideosNotification()
    {
        
    }
}

// ping youtube
$youtube  = new Youtube();

// ping to self 
$myself = new YoutubeUser();

// me: telling you give my new videos update 
// youtube: keep pinging me I will update whenever I can
// No that's a a very heavy job I have other works to do
// ok give me your identity
// so whenever I have an update I will update you
// you will get my update immedialty if you are logged in
// me: cool ok let me tell you who I am and my address

$myself = new YoutubeUser($youtube);