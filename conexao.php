<?php
//TODO: instalar o composer
//https://getcomposer.org/download/

//TODO: phpuni


function fabricaConexao(){
  try {

    $hostname = "127.0.0.1";
    $dbname = "mailmax";
    $username = "uis";
    $pw = "XA15a#s@Bz5CGEVS";
    $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch (PDOException $e) {
    echo "Erro de Conexão " . $e->getMessage() . "\n";
    exit;
  }
  return $pdo;
}