<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">   
            <div id="deco">
                <img src="bitcoin-3089728_1920.jpg"/>
                <p id="formuleentete">Bienvenue chez Gk-Force</p>
            <div>         
            <form action="authorisation.php" method="POST">
                <h1>Connexion</h1>
                <label for="username"><b>Nom d'utilisateur :</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required></br>
                </br>
                <label for="password"><b>Mot de passe :</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required></br>
                </br>
                <input type="submit" class='submit' value='Inscription' >

                <input type="submit" class='submit' value='Connexion' >
            </form>
        </div>
    </body>
</html>