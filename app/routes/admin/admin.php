<?php

$app->get('/admin', function($req, $res, $args) {
  return $this->view->render($res, 'admin/admin.php');
})->setName('admin')->add($adminCheck($container));
