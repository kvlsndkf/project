<?php

abstract class Social
{
    //attributes
    public string $github = "";
    public string $instagram = "";
    public string $facebook = "";
    public string $linkedin = "";

    //getters and setters
    public function getGithub()
    {
        return $this->github;
    }
    public function setGithub($github)
    {
        $this->github = $github;
    }
    //----------------------------
    public function getInstagram()
    {
        return $this->instagram;
    }
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;
    }
    //----------------------------
    public function getFacebook()
    {
        return $this->facebook;
    }
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }
    //----------------------------
    public function getLinkedin()
    {
        return $this->linkedin;
    }
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;
    }
    //----------------------------
}