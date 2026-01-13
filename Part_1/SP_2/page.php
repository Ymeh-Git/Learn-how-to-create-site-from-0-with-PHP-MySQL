<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LES FONDAMENTAUX WEB ET PHP</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html{
            background-color: grey;
        }

        body{
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Body is force to at least be 100% height of the screen */
            overflow-x: hidden; /* Make horizontal scrolling impossible */
        }

        header, footer{
            background-color: grey;
            height: 200px;
            text-align: center;
            align-content: center;
        }
        
        main{
            background: black;
            color : Green;
            flex: 1; /* Pushs footer down even if the content is short */
            padding: 15px;
            width: 70%; 
            margin: auto; /* This way your main content will be centered */
        }

        div{
            background-color: black;
            color: white;
        }

    </style>
</head>
    <body>
    <!-- Header -->
    <header>
        <div>
            Variables et opérations
        </div>
    </header>

    <!-- Main content -->
    <main>
        <?php require_once('index.php')?>
    </main>

    <!-- Footer -->
    <footer>
        <div>
            Tout droit réservé - YmehGit
        </div>
    </footer>
</body>
</html>