<?php 
    include './Lab4Common/Header.php';
    include './Lab4Common/Functions.php';
?>

<?php 
    session_start();
    $principalAmount = $_POST["principalAmount"];
    $interestRate = $_POST["interestRate"];
    $years = $_POST["years"];
   
    $principalAmountErrorMsg = "";
    $interestRateErrorMsg = "";
    $yearsErrorMsg = "";
    $validation = false;
    
    if(!isset($_SESSION["customerInfo"])){
        header("Location: CustomerInfo.php");
    }
    
    if(isset($_POST["btnClear"])){
        $principalAmount=$interestRate=$years='';
        $_POST = array();
    }
    
    if(isset($_POST["btnSubmit"])){
        $principalAmountErrorMsg = ValidatePrincipal($principalAmount);
        $interestRateErrorMsg = ValidateRate($interestRate);
        $yearsErrorMsg = ValidateYears($years);
        
        // validate all the form
        if($principalAmountErrorMsg=="" && $interestRateErrorMsg=="" && $yearsErrorMsg==""){
            $validation = true;
        } 
    }
    
 

?>

<div class="container">
    <h1>Deposit Calculator</h1>
    <p>Enter principal amount, interest rate and select number of years to deposit</p>
    
    <form method = "POST" action = "<?=$_SERVER['PHP_SELF'];?>">
        <div class="form-group row">
            <label for="principalAmount" class="col-lg-2 col-form-label">Principal Amount:</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" name="principalAmount" id="principalAmount" value="<?php echo $_POST["principalAmount"]; ?>"/>
            </div>
            <div class="col-lg-7 text-danger"><?php echo $principalAmountErrorMsg ?></div>
        </div>


        <div class="form-group row">
            <label for="interestRate" class="col-lg-2">interest Rate(%):</label>
            <div class="col-lg-3">
                <input type="text" class="form-control" name="interestRate" id="interestRate" value="<?php echo $_POST["interestRate"]; ?>"/>
            </div>
            <div class="col-lg-7 text-danger"><?php echo $interestRateErrorMsg ?></div>
        </div>


        <div class="form-group row">
            <label for="years" class="col-lg-2">Years to Deposit:</label>
            <div class="col-lg-3">
                <select class="form-control" name="years" id="inputYears">
                    <option value="-1" <?php if (isset($years) && $years=="-1") echo "selected";?>>select...</option>
                    <?php 
                    for ($i = 1; $i < 21; $i++) {
                        echo "<option value='$i'";
                        if(isset($years)&&$years=="$i"){
                            echo "selected";
                        }
                        echo ">$i";
                        echo "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-7 text-danger"><?php echo $yearsErrorMsg ?></div>
        </div>  
        <button type="submit" name="btnSubmit" class="btn btn-primary">Calculate</button>
        <button type="submit" name="btnClear" id="btnClear" value="clear" class="btn btn-primary">Clear</button>

    </form>
</div>

<?php 
    if($validation == true){
?>
    <!--display the table-->
    <div class="container">
        <p>The following is the result of the calculation:</p>
        <div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th scope="col">Year</th>
                      <th scope="col">Principal at Year Start</th>
                      <th scope="col">Interest for the Year</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            for($i=0; $i<$years; $i++)
            {
                echo "<tr>";
                echo "<td>";
                echo $i + 1;
                echo "</td>";
                echo '<td>';
                printf("%0.2f", $principalAmount);
                echo '</td>';
                echo '<td>';
                printf("%0.2f", $principalAmount * ($interestRate / 100));
                echo '</td>';
                echo "</tr>";

                $principalAmount = $principalAmount * (1 + $interestRate / 100);

            }
            ?>        
                </tbody>
            </table>
        </div>
    </div>
    
<?php }?>

<?php include './Lab4Common/Footer.php'; ?>