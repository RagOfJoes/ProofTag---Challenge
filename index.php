<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProofTag Challenge</title>
    <!-- Font CDN -->
    <link href="https://fonts.googleapis.com/css?family=DM+Serif+Text&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require_once("./prooftag/submit.php"); ?>
    <div class="container">
        <!-- BG -->
        <div class="rowOne"></div>

        <!-- Init. Form -->
        <div class="rowTwo">
            <form method="post" action="<?php /* Sanitize Input */ echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <div class="userInput">
                    <h1 class="tagNumberLabel">AUTHENTICATION</h1>
                    <input type="text" name="tagNumber" id="tagNumberInput" placeholder="Tag Number" autofocus>
                    <h1 class="tagNumberError"><?php echo $tagError ?></h1>
                </div>
            </form>
        </div>

        <!-- TODO: Create Modal to display info -->
    </div>
</body>

</html>