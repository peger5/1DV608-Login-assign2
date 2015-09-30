<?php


class LayoutView {
  
  public function renderLogin($isLoggedIn, LoginView $v, DateTimeView $dtv, $message, NavigationView $nv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Assignment 2</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $nv->getLinks() . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v->response($message) . ' 
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  public function renderRegister($isLoggedIn, RegistrationView $rv, DateTimeView $dtv, $message, NavigationView $nv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Assignment 2</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $nv->getLinks() . $this->renderIsLoggedIn($isLoggedIn) . '
          <h2>Register new user</h2>
          <div class="container">
              ' . $rv->response($message) . ' 
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
