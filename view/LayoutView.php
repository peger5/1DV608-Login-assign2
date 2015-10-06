<?php


class LayoutView {
  
  public function renderLogin($isLoggedIn, LoginView $v, DateTimeView $dtv, NavigationView $nv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Assignment 4</title>
        </head>
        <body>
          <h1>Assignment 4</h1>
          ' . $nv->getLinks() . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v->response() . ' 
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  public function renderRegister($isLoggedIn, RegisterView $rv, DateTimeView $dtv, NavigationView $nv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Assignment 4</title>
        </head>
        <body>
          <h1>Assignment 4</h1>
          ' . $nv->getLinks() . $this->renderIsLoggedIn($isLoggedIn) . '
          <h2>Register new user</h2>
          <div class="container">
              ' . $rv->generateRegistrationFormHTML() . ' 
              
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
