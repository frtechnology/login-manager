# lOGIN PHP

Simple php login manager

## installation

o install this dependency, just run the command below:
	```shell
		composer require frtechnology/login-php
	```

## Usage

To use this library just follow the examples below:

```php
    <?php
		require __DIR__.'/vendor/autoload.php';

	    use \RafaelRogerio\User\Login;

        //VERIFY SUBMIT BUTTON
	    if (isset($_POST['submit'])) {
			/** DATABASE CONFIG
			 * params $host string
			 * params $dbname string
			 * params $user string
			 * params $pass string
			 * */		
		    Login::config('localhost','frcursos','root','');
            //NOVA INSTACIA DE LOGIN
		    $obUser = new Login;
			//SESSION
			Login::
			/** SWITCH ON DATABASE CONNECTION
			 * params $table string
			 * */
		    $obUser->connectDb('login');
            /** SET LOGIN
			 * params $_POST['email'] string
			 * params $_POST['password'] string
			 * params $email string (field where the user's email will be searched)
			 * params $location string (location where the user will be redirected)
			 * return string (Error Mesaage)
			 * */
		    $status = $obUser->setLogin($_POST['email'], $_POST['senha'],'email', 'http://localhost/FRcursos');
		
	    }
	
	
```
```html
	<section class="form">
     <div class="login">
        <h4>Login</h4>
        <form method="post" action="">
```
            ```php
                echo $status;
            ```
```html
          <div class="input-coloms">
             <i class="fas fa-user"></i>
             <input type="text" name="email" required autofocus>
             <label>Email do Usuario</label>
          </div>
          <div class="input-coloms">
            <i class="fas fa-unlock-alt"></i>
             <input type="password" name="senha" required>
             <label>Senha</label>
          </div>
          <div class="option-form">
            <button type="submit" name="submit">Logar</button>
            <a href="{{URL}}/cadastro">Cadastrar</a>
          </div>
        </form>
     </div>
   </section>
```

#### create a session with the data from the database

```php

		require __DIR__.'/vendor/autoload.php';

	    use \RafaelRogerio\User\Login;

        //VERIFY SUBMIT BUTTON
	    if (isset($_POST['submit'])) {
            //DATABASE CREDENTIALS		
		    Login::config('localhost','frcursos','root','');
            //INSTANCE
		    $obUser = new Login;
			//SESSION
			$obUser->setTypeSession([
				'id',
				'email'
			])
            //DATABASE CONNECT
		    $obUser->connectDb('login');
            
		    $status = $obUser->setLogin($_POST['email'], $_POST['senha'],'email', 'http://localhost/FRcursos');
		
	    }
	
	
```
## NOTE:

	mandatory to have in you database the email field that will store the entire email, the senha field that will store the passwords

## Requirements
- This library needs PHP 7.0 or greater.
