<?php
require_once('/xampp/htdocs' . '/project/classes/denunciations/Denunciation.class.php');

$denunciation = new Denunciation();

$list['contexts'] = $denunciation->getContextsForModal();

echo json_encode($list);
