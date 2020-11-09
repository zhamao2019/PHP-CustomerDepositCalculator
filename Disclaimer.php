<?php 
    include './Lab4Common/Header.php';
    include './Lab4Common/Functions.php';
?>
<?php 
    session_start();
    $checkErrorMsg = '';
    $checkBox = $_POST['check'];

    
    if(isset($_POST['btnSubmit'])){
        if(!isset($checkBox)){
            $checkErrorMsg = "You must agree the terms and conditions";
        }
        else {
            $checkErrorMsg = "";
            $_SESSION["terms"] = $checkBox;
            header("Location: CustomerInfo.php");
        }
    }

?>


<div class="container">
    <h1>Terms and Conditions</h1>
    <ul class="list-group">
        <li class="list-group-item">
            THESE TERMS AND CONDITIONS RELATE TO THE USE OF THE MCDONALD’S.CA WEBSITE (THE “SITE”) AND THE MOBILE APPLICATION (THE “MOBILE APPLICATION”) OF MCDONALD’S RESTAURANTS OF CANADA LIMITED (“MCDONALD’S”), INCLUDING ANY CONTENT THEREIN (COLLECTIVELY THE SITE AND THE MOBILE APPLICATION SHALL HEREINAFTER BE REFERRED TO AS THE “APPLICATION”):
            FOR IPHONE, IPAD AND OTHER DEVICES USING THE IPHONE OS (“APPLE APPLICATIONS”); AND FOR DEVICES USING ANOTHER OS (“OTHER APPLICATIONS”).
        </li>
        <li class="list-group-item"> BY DOWNLOADING, INSTALLING, ACCESSING OR OTHERWISE USING THE APPLICATION, YOU AGREE TO BE BOUND BY THESE TERMS AND CONDITIONS (“TERMS”). IF YOU DO NOT AGREE, YOU SHOULD NOT DOWNLOAD, INSTALL, ACCESS OR OTHERWISE USE THE APPLICATION. IF YOU HAVE INSTALLED THE APPLICATION AND DO NOT AGREE TO THESE TERMS, THEN YOU MUST UNINSTALL THE APPLICATION IMMEDIATELY. THESE TERMS FORM A LEGAL AGREEMENT BETWEEN YOU AND MCDONALD’S (“AGREEMENT”). THIS AGREEMENT CONTAINS PROVISIONS THAT LIMIT THE LIABILITY OF MCDONALD’S.</li>
    </ul>
    
    <form method = "POST" action = "<?=$_SERVER['PHP_SELF'];?>">
        <div class="form-check">
            <div class="text-danger"><?php echo $checkErrorMsg ?></div>
            <input class="form-check-input" type="checkbox" id="check" name="check[]" value="terms" <?php if(isset($_SESSION["terms"])){ echo 'checked'; } ?>>
            <label class="form-check-label" for="check">
              I have read and agree with the terms and conditions
            </label>
        </div>
        <button type="submit" class="btn btn-primary" name="btnSubmit">Start</button>
    </form>
</div>

<?php include './Lab4Common/Footer.php'; ?>

