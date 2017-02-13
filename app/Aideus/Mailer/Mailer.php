<?php

namespace Aideus\Mailer;

class Mailer
{
  private $view;

  private $mailer;

  public function __construct($view, $mailer)
  {
      $this->view = $view;
      $this->mailer = $mailer;
  }

  public function send($template, $data, $cb)
  {
      $msg = new Message($this->mailer);

      foreach ($data as $key => $value) {
          $this->view[$key] = $value;
      }

      //$this->view->render($res, $template)
      $msg->setBody('dfgdfgdfg');

      call_user_func($cb, $msg);

      $this->mailer->send();
  }
}
