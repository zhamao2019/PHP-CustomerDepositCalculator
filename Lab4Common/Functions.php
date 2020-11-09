<?php

    // if pricipal amount is blank or a negative number or not a number
    function ValidatePrincipal($amount) {
        if(!trim($amount)){
            return $errorMsg = "The principal amount can not be blank";
        }
        else if ($amount < 0 || !is_numeric($amount)) {
            return $errorMsg = "The principal amount must be numeric and greater than 0";
        }
        else {
            return $errorMsg = "";
           }
        }
    // if interest rate is blank or a negative number or not a number
    function ValidateRate($rate) {
        if(!trim($rate)){
            return $errorMsg = "The interest rate can not be blank";
        }
        elseif (!is_numeric($rate) || $rate < 0 ){
            return $errorMsg = "The interest rate must be numeric and non-negative";
        }
        else {
            return $errorMsg = "";
        }  
    }
    // if year is blank
    function ValidateYears($years) {
        if( $years == '-1' ){
            return $errorMsg = 'You must select your deposit year';
        }
        else {
            return $errorMsg = "";
        }
    }
    // if name is blank
    function ValidateName($name) {
        if( !trim($name) ){
            return $errorMsg = 'Name can not be blank';
        }
        else {
            return $errorMsg = "";
        }
    }
    // if postal code is blank or incorrect format
    function ValidatePostalCode($postCode) {
        // XnX XnX
        $postalCodeRege = "/^[a-zA-Z][0-9][a-zA-Z] \s*[0-9][a-zA-Z][0-9]{1}$/i";

        if( !trim($postCode) ){
            return $errorMsg = 'Postal code can not be blank';
        }
        elseif(!preg_match($postalCodeRege, $postCode) ) {
            return $errorMsg = 'Incorrect Postal Code Format';
        }
        else {
            return $errorMsg = "";
        }
    }
    // if phone is blank or incorrect format
    function ValidatePhone($phone) {
        // nmm-nmm-mmm, n is not 0 or 1
        $phoneRege = "/^[2-9](\d{2})-[2-9](\d{2})-(\d{4})$/i";

        if( !trim($phone) ){
            return $errorMsg = 'Phone number can not be blank';
        }
        elseif(!preg_match($phoneRege, $phone)) {
            return $errorMsg = "Incorrect Phone Format";
        }
        else {
            return $errorMsg = "";
        }
    }
    // if email is blank or incorrect format
    function ValidateEmail($email) {
        // xxxxxx@xxxx.cccc, cccc is 2-4 chars
        $emailRege = "/\b[a-zA-Z0-9._%+-]+@(([a-zA-Z0-9-]+)\.)+[a-zA-Z]{2,4}$/i";

        if( !trim($email)){
            return $emailErrorMsg = 'Email can not be blank';
        }
        elseif(!preg_match($emailRege, $email)) {
            return $errorMsg = "Incorrect Email Format";
        }
        else {
            return $errorMsg = "";
        }
    }
    // if contact method is phone, user need to select the contact time
    function ValidateContact($method, $time){
        
        if(isset($method) && $method == 'phone'){
            $emailContact = '';
            $phoneContact = 'checked';
            //return array($contact);
            
            if(!isset($time)){
                return $contactTimeErrorMsg = "When preferred contact method is phone, you need to select one or more contact times";    
            }
        }
        elseif (isset($method) && $method == 'email') {
            return $emailContact = 'checked';
            $phoneContact = '';
        }
    }

?>
