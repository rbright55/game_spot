<html>
    <head>
        <title>Test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <script src="scoreoutput.js"</script>    
        
<?php
$score = $_GET['score'];
$UID = $_GET['UID'];
?>
        
<p>The score is: <?php print $score ?></p>   
<p>The User ID is: <?php print $UID ?></p>
        
        
        
    </body>
</html>