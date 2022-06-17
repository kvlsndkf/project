<?php
require_once('/xampp/htdocs' . '/project/classes/followers/Follow.class.php');

if (isset($_POST['follow'])) {
    $followerID = $_GET['idfollower'];
    $followingID = $_GET['idFollowing'];
    $perfilUser = $_GET['idPerfil'];

    $follow = new Follow();
    $follow->setFollowerId($followerID);
    $follow->setFollowingId($followingID);
    $follow->unfollowers($follow, $perfilUser);
}