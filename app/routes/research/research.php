<?php

use Aideus\Publication\Publication;

$app->get('/research', function ($req, $res, $args) {

    $agiPublications = Publication::where('category', 0)->get();

    foreach ($agiPublications as $key => $publication) {
        $agiPbl[$key] = $publication;
    }

    $prevPublications = Publication::where('category', 1)->get();

    foreach ($prevPublications as $key => $publication) {
        $prevPbl[$key] = $publication;
    }

    return $this->view->render($res, 'research/research.php', ['agiPbl' => $agiPbl, 'prevPbl' => $prevPbl]);
})->setName('research');
