<?php
// connect to databse
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_curd','root', '' );
  $pdo->setAttribute(PDO:: ATTR_ERRMODE , PDO:: ERRMODE_EXCEPTION); // GETING ERRORS