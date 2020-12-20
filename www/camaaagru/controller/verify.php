<?php
    $user = $_GET['user'];
    $email = $_GET['email'];
    $random = $_GET['random'];
    if(!empty($user) && !empty($email) && !empty($random))
    {
        include     'connect_db.php';
        $reponse = $bdd->query('SELECT * FROM users WHERE username =\'' . $user . '\'');
        $donnees = $reponse->fetch();
        if($donnees['username'] == $user && $donnees['email'] == $email && $donnees['random'] == $random)
        {
        $req = $bdd->prepare('UPDATE users SET active = 1, random = "0000" WHERE username = :un');
        $req->execute(array(
            'un' => $user
            ));
        }
        ?><script type='text/javascript'>alert('your account has been confirmed, just go and log in!');</script>;
        <script>window.close();</script>;
        <?php
        exit(0);
    }
    if(!empty($user) && !empty($email))
    {
        include     'connect_db.php';
        $reponse = $bdd->query('SELECT * FROM users WHERE username =\'' . $user . '\'');
        $donnees = $reponse->fetch();
        if($donnees['username'] == $user && $donnees['email'] == $email && $donnees['random'] == "0999")
        {
        $req = $bdd->prepare('UPDATE users SET random = "0000" WHERE username = :un');
        $req->execute(array(
            'un' => $user
            ));
        }
        ?><script type='text/javascript'>alert('your account has been confirmed, just go and log in!');</script>;
        <script>window.close();</script>;
        <?php
        exit(0);
    }
?>