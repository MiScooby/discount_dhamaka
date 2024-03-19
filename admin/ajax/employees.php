<?php include('config.php');


if (isset($_POST['AddEmployee'])) {

    $EmpRole = $_POST['EmpRole'];
    $EmployeeFirstName = $_POST['EmployeeFirstName'];
    $EmployeeLastName = $_POST['EmployeeLastName'];
    $mob_num = $_POST['mob_num'];
    $alt_mob_num = (empty($_POST['alt_mob_num'])) ? $_POST['mob_num']  :  $_POST['alt_mob_num'];
    $EmployeeDob =  $_POST['EmployeeDob'];
    $EmployeeEmail =  $_POST['EmployeeEmail'];
    $emp_Password = $_POST['emp_Password'];
    $emp_Password_cfm_1 = $_POST['emp_Password_cfm'];
    $emp_Password_cfm = hash('sha256', $emp_Password_cfm_1);

    $jobDesc = $_POST['jobDesc'];



    $getEmpCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `ec_employee` WHERE `email`='$EmployeeEmail' AND `primary_phone_no`='$mob_num' "));
    if ($getEmpCount == 0) {
        if ($emp_Password == $emp_Password_cfm_1) {
            $addEmpQ = mysqli_query($con, "INSERT INTO `ec_employee`(`first_name`, `last_name`, `role_id`, `email`, `password`, `primary_phone_no`, `alternate_phone_no`, `date_of_birth`, `job_description`) VALUES ('$EmployeeFirstName', '$EmployeeLastName', '$EmpRole', '$EmployeeEmail', '$emp_Password_cfm', '$mob_num', '$alt_mob_num',  '$EmployeeDob', '$jobDesc')");
            
            
            mysqli_query($con, "INSERT INTO `user_temp`(  `user_type`,  `email_id`, `otp`) VALUES ('employee', '$EmployeeEmail', '1234')");

            if ($addEmpQ) {
                $data['email'] = $EmployeeEmail;
                $data['message'] = 'Employee Added Successfully';
                $data['status'] = true;
            } else {
                $data['message'] = 'Error Occur in Employee adding process';
                $data['status'] = false;
            }
        } else {
            $data['message'] = 'Password Not Matched !';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Employee Alredy Exist !';
        $data['status'] = false;
    }
}

if (isset($_POST['VerifyEmployee'])) {

    $EmpOtp = $_POST['EmpOtp'];
    $emailEmp = $_POST['emailEmp'];

    $gtetOpt = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `user_temp` WHERE `email_id`='$emailEmp'"));
    $srvrOtp = $gtetOpt['otp'];
    if ($srvrOtp == $EmpOtp) {
        $updateEmp = mysqli_query($con, "UPDATE `ec_employee` SET `email_verified`='1',`status`='1' WHERE `email`='$emailEmp' ");
        // echo "UPDATE `ec_employee` SET `email_verified`='1',`status`='1' WHERE `email`='$emailEmp'";
        $updateLoginEmp = mysqli_query($con, "UPDATE `secure_login` SET `status`='1' WHERE `user_name`='$emailEmp' ");

        if ($updateEmp) {
            $data['message'] = 'Employee Added Successfully';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error Occur in Employee Creation';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Wrong OTP Entered';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "EmpDlt") {
    $empID = $_POST['empID'];
    $dltEmp =  mysqli_query($con, "DELETE FROM `ec_employee` WHERE `id`='$empID' "); 
    if ($dltEmp) {
        $data['message'] = 'Employee Delted Successfully';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error Occur in Employee delete process';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "EmpVeriOtpSend") {
    $emailEmp = $_POST['emailEmp'];
    $addOtpEmp =   mysqli_query($con, "INSERT INTO `user_temp`(  `user_type`,  `email_id`, `otp`) VALUES ('employee', '$emailEmp', '1234')");

    if ($addOtpEmp) {
        $data['message'] = 'OTP Sent On Mail';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error Occur in sent otp';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "EmpSts") {
    $emplid = $_POST['emplid'];
    $EMpstatus = $_POST['EMpstatus'];
    $dltEmp =  mysqli_query($con, "UPDATE `ec_employee` SET  `status`='$EMpstatus' WHERE `id`='$emplid' "); 
    if ($dltEmp) {
        $data['message'] = 'Employee Status Changed Successfully';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error Occur in Employee status process';
        $data['status'] = false;
    }
}
echo json_encode($data);
