<!DOCTYPE html>
<html lang="en">

<!-- Header section -->
<header>
  <h1>
    <img src="https://www.wildcodeschool.com/assets/logo_main-e4f3f744c8e717f1b7df3858dce55a86c63d4766d5d9a7f454250145f097c2fe.png" alt="Wild Code School logo" />
    Les Argonautes
  </h1>
  <link rel="stylesheet" href="./style.css" />
</header>

<!-- Main section -->
<main>
  
  <!-- New member form -->
  <h2>Ajouter un(e) Argonaute</h2>
  <form action="index.php" method="POST" class="new-member-form">
    <label for="name">Nom de l&apos;Argonaute</label>
    <input id="name" name="name" type="text" placeholder="Charalampos" />
    <button type="submit">Envoyer</button>
  </form>

  
  <?php
  // Connection to database
    try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }

    //name accordance
    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      $errors = array(); // for recording the errors
    } 
    if(!empty($_POST['name']) and empty($errors)) 
    {
      $name = htmlspecialchars($_POST['name']);
        if(preg_match('#^[a-zA-ZÀ-ÖØ-öø-ÿœŒ]+$#',$name))
        {
          $req = $bdd->prepare('INSERT INTO visitors(name) VALUES(:name)');
          $req->execute(array(
          'name' => $name
          ));
        }
        else
        {
          echo 'Veuillez entrer un prénom ne comportant que des lettres.';
        }
    } 
     
  //Add a name in the database
  if(empty($errors)) {
    ?>
    
    <!--Member list-->
    <div class="line"><hr></div>
    <h2>Membres de l'équipage</h2>
    <div class="line"><hr></div>
      <div class="member-list">
        
     
        <div id="firstColomn">
       
          <?php
            $reponse = $bdd->query('SELECT * FROM visitors LIMIT 0,5');
            while ($donnees = $reponse->fetch())
            {
              echo $donnees['name'].'<br>';
            }
          ?>
        </div>
       

        <div id="secondColomn">
          <?php
            $reponse = $bdd->query('SELECT * FROM visitors LIMIT 5,5');
            while ($donnees = $reponse->fetch())
            {
              echo $donnees['name'].'<br>';
            }
          ?>
        </div>

        <div id="thirdColomn">
          <?php
            $reponse = $bdd->query('SELECT * FROM visitors LIMIT 10,5');
            while ($donnees = $reponse->fetch())
            {
              echo $donnees['name'].'<br>';
            }
          ?>
        </div>
        


  <?php
    //$req->closeCursor();
  }
?>
  

  
</main>
</html>