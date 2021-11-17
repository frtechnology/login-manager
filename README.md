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

	    use \RafaelRogerio\LoginManager\Login;

        //VERIFY IF THE SUBMIT WAS PRECEDED
	    if (isset($_POST['submit'])) {	
        	/**
        	 * DATABASE CONFIG
        	 * @param string $host
         	 * @param string $dbname
         	 * @param string $user
        	 * @param string $pass
        	*/
		    Login::databaseConfig('localhost','frcursos','root','');

        	/**
        	 * NEW INSTANCE
        	 * @param string $email
        	 * @param string $password
        	 * @param string $table
        	 * @param string $camp (where will the email be fetched)
        	 * @param string $location
        	*/
		    $obUser = new Login($_POST['email'], $_POST['senha'],'login','email', 'http://google.com');
            $obUser->setLogin();
		    $status = $obUser->getMessage();
		
	    }
	?>
	
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

	<?php
    	require __DIR__.'/vendor/autoload.php';

	    use \RafaelRogerio\LoginManager\Login;

        //VERIFY IF THE SUBMIT WAS PRECEDED
	    if (isset($_POST['submit'])) {	
        	/**
        	 * DATABASE CONFIG
        	 * @param string $host
         	 * @param string $dbname
         	 * @param string $user
        	 * @param string $pass
        	*/
		    Login::databaseConfig('localhost','frcursos','root','');

        	/**
        	 * NEW INSTANCE
        	 * @param string $email
        	 * @param string $password
        	 * @param string $table
        	 * @param string $camp (where will the email be fetched)
        	 * @param string $location
        	*/
		    $obUser = new Login($_POST['email'], $_POST['senha'],'login','email', 'http://google.com');
            $obUser->setTypeSession([
                'id',
                'email'
            ]);
            $obUser->setLogin();
		    $status = $obUser->getMessage();
		
	    }
	?>
	
```
## NOTE:

	mandatory to have in you database the email field that will store the entire email, the senha field that will store the passwords

## Requirements
- This library needs PHP 7.0 or greater.
