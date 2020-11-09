<?php 
include './Lab4Common/Header.php';
include './Lab4Common/Functions.php';
?>
<?php 
    session_start();
    
    if(isset($_SESSION["customerInfo"])){
        $info = $_SESSION["customerInfo"];
        $name = $info[0];
        $phone = $info[2];
        $email = $info[3];
        $contactMethod = $info[4];
        $contactTime = $info[5];
//        $name = $info["name"];
//        $phone = $info["phone"];
//        $email = $info["email"];
//        $contactMethod = $info["method"];
//        $time = $info["time"];
?>

<div class="container">
    <h1>Thank you, <span class="text-primary"><?php echo $name ?></span>, for using deposit calculator</h1>
    <p>Our customer service department will call you tomorrow

    <?php 
        if($contactMethod == 'phone'){
            // print the contact time that user has selected
            $txtTime = '';
            foreach($contactTime as $time )									
                {
                    $txtTime = $txtTime. $time. " or ";
                }
            $txtTime = rtrim($txtTime, 'or ');
            echo "$txtTime at $phone. </p>";
        }
        else{
            echo "by email at $email. </p>";
        }
    ?>
</div>

<?php }else { ?>
<div class="container">
    <h1>Thank you for using our deposit calculation tool</h1>
</div>
<?php } ?>

<?php include './Lab4Common/Footer.php'; ?>