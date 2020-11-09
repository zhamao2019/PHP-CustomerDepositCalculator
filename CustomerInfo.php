<?php 
include './Lab4Common/Header.php';
include './Lab4Common/Functions.php';
?>
<?php 
    session_start(); 
?>
<?php 

    $name = $_POST["name"];
    $postCode = $_POST["postCode"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $contactMethod = $_POST["contactMethod"];
    $contactTime = $_POST["contactTime"];

    $nameErrorMsg = "";
    $postCodeErrorMsg = "";
    $phoneErrorMsg = "";
    $emailErrorMsg = "";
    $contactTimeErrorMsg = "";
    $validation = false;
    
    if(!isset($_SESSION["terms"])){
        header("Location: Disclaimer.php");
    }
        
    if(isset($_POST["btnClear"])){
        $name=$email=$phone=$postCode=$contactMethod=$contactTime="";
        $_POST = array();
    }
    
    if(isset($_POST["btnSubmit"])){
        $nameErrorMsg = ValidateName($name);
        $postCodeErrorMsg = ValidatePostalCode($postCode);
        $phoneErrorMsg = ValidatePhone($phone);
        $emailErrorMsg = ValidateEmail($email);
        //$contactTimeErrorMsg = ValidateContact($contactMethod, $contactTime);
       
        // if contact method is phone, user need to select the contact time
        if(isset($_POST["contactMethod"]) && $contactMethod == 'phone'){
            $emailContact = '';
            $phoneContact = 'checked';
            if(!isset($contactTime)){
                $contactTimeErrorMsg = "When preferred contact method is phone, you need to select one or more contact times";    
            }
        }
        elseif (isset($_POST["contactMethod"]) && $contactMethod == 'email') {
            $emailContact = 'checked';
            $phoneContact = '';
        }
            
        // validate all the form
        if( $nameErrorMsg=="" && $postCodeErrorMsg=="" && $phoneErrorMsg =="" && $emailErrorMsg=="" && $contactTimeErrorMsg=="" ){
            $validation = true;
            $customerInfoArr = array($name, $postCode, $phone, $email, $contactMethod, $contactTime);
//            $customerInfoArr = array('name', 'postCode', 'phone', 'email', 'method', 'time');
//            $customerInfoArr['name'] = $name;
//            $customerInfoArr['postCode'] = $postCode;
//            $customerInfoArr['phone'] = $phone;
//            $customerInfoArr['email'] = $email;
//            $customerInfoArr['method'] = $contactMethod;
//            $customerInfoArr['time'] = $contactTime;
        }  
  
        if($validation == true){
            $_SESSION["customerInfo"] = $customerInfoArr;
            header("Location: DepositCalculator.php");
        }
    }     
?>

<div class="container">
    <h1>Custormer Information</h1>
    
    <form method = "POST" action = "<?=$_SERVER['PHP_SELF'];?>">
        <div class="form-group row">
            <label for="Name" class="col-lg-2">Name:</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $_POST["name"]; ?>"/>
            </div>
            <div class="col-lg-7 text-danger"><?php echo $nameErrorMsg ?></div>
            </div>
            <div class="form-group row">
                <label for="postalCode" class="col-lg-2">Postal Code:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="postCode" id="postalCode" value="<?php echo $_POST["postCode"]; ?>"/>
                </div>
                <div class="col-lg-7 text-danger"><?php echo $postCodeErrorMsg ?></div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-lg-2">Phone Number:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $_POST["phone"]; ?>"/>
                <small id="phoneStyle" class="form-text text-muted">(nnn-nnn-nnnn)</small>
                </div>
                <div class="col-lg-7 text-danger"><?php echo $phoneErrorMsg ?></div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-lg-2">Email Adress:</label>
                <div class="col-lg-3">
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $_POST["email"]; ?>"/>
                </div>
                <div class="col-lg-7 text-danger"><?php echo $emailErrorMsg ?></div>
            </div>

            <hr class="mt-5" />

            <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-lg-4 pt-0">Preferred Contact Method:</legend>
                  <div class="col-lg-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="contactMethod" id="radPhone" value="phone" <?=$phoneContact?> checked>
                      <label class="form-check-label" for="radPhone">Phone</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="contactMethod" id="radEmail" value="email" <?=$emailContact?>>
                      <label class="form-check-label" for="radEmail">Email</label>
                    </div>
                  </div>
                </div>
            </fieldset>

            <fieldset class="form-group mb-5">
                <legend class="col-form-label pt-0">If phone is selected, when can we contact you? (Check all applicable)</legend>
                  
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="contactTime[]" id="contactTimeM" value="morning" 
                        <?php 
                        if(isset($_POST["btnSubmit"]) && $_POST["contactTime"]){
                            if(in_array('morning', $_POST["contactTime"])) {echo 'checked';}
                        } 
                        ?>>
                    <label class="form-check-label" for="contactTimeM">Morning</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="contactTime[]" id="contactTimeA" value="afternoon" 
                        <?php 
                        if(isset($_POST["btnSubmit"]) && $_POST["contactTime"]){
                            if(in_array('afternoon', $_POST["contactTime"])) {echo 'checked';}
                        } 
                        ?>>
                    <label class="form-check-label" for="contactTimeA">Afternoon</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="contactTime[]" id="contactTimeE" value="evening" 
                        <?php 
                        if(isset($_POST["btnSubmit"]) && $_POST["contactTime"]){
                            if(in_array('evening', $_POST["contactTime"])) {echo 'checked';}
                        } 
                        ?>>
                    <label class="form-check-label" for="contactTimeE">Evening</label>
                </div>  
                <div class="text-danger"><?php echo $contactTimeErrorMsg ?></div>
            </fieldset>

            <button type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
            <button type="submit" name="btnClear" id="btnClear" value="clear" class="btn btn-primary">Clear</button>
    </form>
</div>

<?php include './Lab4Common/Footer.php'; ?>