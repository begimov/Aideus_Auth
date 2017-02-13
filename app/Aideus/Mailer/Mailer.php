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

  public function send($res, $template, $data, $cb)
  {

      $msg = new Message($this->mailer);

      foreach ($data as $key => $value) {
          $this->view[$key] = $value;
      }

      $msg->setBody($this->view->render($res, $template));

      call_user_func($cb, $msg);

      try {
          $this->mailer->send();
      } catch (phpmailerException $e) {
          echo $e->errorMessage();
      } catch (Exception $e) {
          echo $e->getMessage();
      }
  }
}
