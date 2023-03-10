<?php 
    include("config.php");
    use FTP\Connection;


    session_start();

    function subsucribe_user($email){
        $con = Connection();

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Email Error</strong> &nbsp; Check Again Your Email
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
        }else{
            $check_sub_user = "SELECT * FROM geting_touch_tbl WHERE g_email = '$email'";
            $check_sub_user_result = mysqli_query($con, $check_sub_user);
            $sub_nor = mysqli_num_rows($check_sub_user_result); 

            if($sub_nor > 0){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error</strong> &nbsp; Email Already Exists...!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            }
            else{
                $insert_email_g = "INSERT INTO geting_touch_tbl(g_email,date_time)VALUES('$email',NOW())";
                $insert_email_g_result = mysqli_query($con, $insert_email_g);

                if(!$insert_email_g_result){
                    return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error</strong> &nbsp; While insert data in to Database
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                }else{
                    return  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Success</strong> &nbsp; Data Insert to DataBase Successfully...!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                }
            }
        }
    }


    function reg_user($username, $email, $pass1, $cpass){
        $con = Connection();

        $check_user = "SELECT * FROM user_tbl WHERE u_username = '$username' && user_email = '$email'";
        $check_user_result = mysqli_query($con, $check_user);
        $check_user_nor = mysqli_num_rows($check_user_result);

        if(empty($username)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Username Error : </strong> &nbsp; Username Cannot be Empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($email)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Email Error : </strong> &nbsp; Email Cannot be Empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Email Error</strong> &nbsp; Check Again Your Email
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($pass1)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Password Error : </strong> &nbsp; Email Cannot be Empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($cpass)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Password Error : </strong> &nbsp; Email Cannot be Empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if($pass1 != $cpass){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Password Error : </strong> &nbsp; Password and Confarm Password doesn't match.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }

        if($check_user_nor > 0){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>User Error : </strong> &nbsp; Email Cannot be Empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }else{
            $insert_user = "INSERT INTO user_tbl(u_username,user_email,user_pass,user_type,join_date,user_status,is_pending)VALUES('$username','$email','$pass1','user',NOW(),0,1)";
            $insert_user_result = mysqli_query($con, $insert_user);

            if(!$insert_user_result){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error : </strong> &nbsp; While insert data in to Database.....!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }else{
                return  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Success</strong> &nbsp; User Created Successflly..! <br>
                            <a href='../views/login.php'>Login To account</a>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }
        }
    }

    function login_user($login_username,$login_pass){
        $con = Connection();

        if(empty($login_username)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Username Error : </strong> &nbsp; Username Cannot be Empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($login_pass)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Password Error : </strong> &nbsp; Password Cannot be Empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>"; 
        }

        $check_user = "SELECT * FROM user_tbl WHERE u_username = '$login_username' && user_pass = '$login_pass'";
        $check_user_result = mysqli_query($con, $check_user); 
        $check_user_row = mysqli_fetch_assoc($check_user_result);

        $_SESSION['getEmail'] = $login_username;


        if($login_username != $check_user_row['u_username']){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; User does not exist.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if($login_pass != $check_user_row['user_pass']){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; User does not exist.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }

        $check_user_is_panding = "SELECT * FROM user_tbl WHERE u_username = '$login_username' && user_pass = '$login_pass' && user_status = 0 && is_pending = 1";
        $check_user_is_panding_result = mysqli_query($con, $check_user_is_panding); 
        $check_user_is_padding_nor = mysqli_num_rows($check_user_is_panding_result);

        if($check_user_is_padding_nor > 0){
            header("location:wating.php");
        }

        $check_login_user = "SELECT * FROM user_tbl WHERE u_username = '$login_username' && user_pass ='$login_pass' && user_status = 1 && is_pending = 0";
        $check_login_user_result = mysqli_query($con, $check_login_user);
        $check_login_user_row = mysqli_fetch_assoc($check_login_user_result);
        $check_login_user_nor = mysqli_num_rows($check_login_user_result);
        
        if($check_login_user_nor > 0){
            if($check_user_row['user_type'] == 'user'){
                setcookie('login',$check_login_user_row['user_email'],time()+60*60,'/');
                $_SESSION['LoginSession'] = $check_login_user_row['user_email'];
                header("location:../routes/user.php");  
            }
            if($check_user_row['user_type'] == 'admin'){
                setcookie('login',$check_login_user_row['user_email'],time()+60*60,'/');
                $_SESSION['LoginSession'] = $check_login_user_row['user_email'];
                header("location:../routes/admin.php");  
            }
        else{
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; While accessing data in Database.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            }
        }

    }
            
    function wating_user(){
        $con = Connection();

        $login_id_user = strval($_SESSION['getEmail']);
        echo $login_id_user;
    }


    function check_otp_email($otp_username, $otp_email){
        $con = Connection();
        $_SESSION['EmailGet'] = $otp_email;
        if(empty($otp_username)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Username Error : </strong> &nbsp; Username Can not be empty
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($otp_email)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Email Error : </strong> &nbsp; Email Can not be empty
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>"; 
        }
        if(!filter_var($otp_email, FILTER_VALIDATE_EMAIL)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Email Error</strong> &nbsp; Check Again Your Email
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
        }

        $check_otp_user = "SELECT * FROM user_tbl WHERE u_username = '$otp_username' && user_email = '$otp_email' && user_status = 1 && is_pending = 0";
        $check_otp_user_result = mysqli_query($con, $check_otp_user);
        $check_otp_user_row = mysqli_fetch_assoc($check_otp_user_result);
        $check_otp_user_nor = mysqli_num_rows($check_otp_user_result);

        if($check_otp_user_nor > 0){
            if($otp_username != $check_otp_user_row['u_username']){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Username Error : </strong> &nbsp; Username does not exist...!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>"; 
            }elseif($otp_email != $check_otp_user_row['user_email']){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Email Error : </strong> &nbsp; Email does not exist...!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }else{
                $check_otp_data = "SELECT * FROM pass_reset_tbl WHERE pass_username ='$otp_username' && pass_email ='$otp_email'";
                $check_otp_data_result = mysqli_query($con, $check_otp_data);
                $check_otp_data_nor = mysqli_num_rows($check_otp_data_result);

                if($check_otp_data_nor > 0){
                    return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Processing Error : </strong> &nbsp; Cannot Process the task...!
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>";
                }else{
                    $otp_num = rand(10000,99999);

                    $receiver = $otp_email;
                    $subject = "Resent Password..!";
                    $body = "OTP For Resent Password /n GYM Workout /n/n OTP is ".$otp_num;
                    $sender = "From:jehankandy@gmail.com";

                    if(mail($receiver,$subject,$body,$sender)){
                        echo "Send";
                    }else{
                        echo "not";
                    }

                    $inset_otp_data = "INSERT INTO pass_reset_tbl(pass_username,pass_email,otp_no,change_date)VALUES('$otp_username','$otp_email','$otp_num',NOW())";
                    $inset_otp_data_result = mysqli_query($con, $inset_otp_data);



                    if(!$inset_otp_data_result){
                        return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <strong>Error : </strong> &nbsp; While inserting data.....!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
                    }else{
                        setcookie('resetPass',$otp_email,time()+5*60,'/');
                        $_SESSION['passReset'] = $otp_email;
                        header("location:otp_pass.php");
                    }
                }
            }
        }else{
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; While Accessing Data in Database.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
    }

    function otp_check($otp_get){
        $con = Connection();

        if(empty($otp_get)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>OTP Error : </strong> &nbsp; Input Feild Connot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        $login_user_otp = strval($_SESSION['EmailGet']);


        $check_pass_otp = "SELECT * FROM pass_reset_tbl WHERE pass_email = '$login_user_otp' && otp_no = '$otp_get'";
        $check_pass_otp_result = mysqli_query($con, $check_pass_otp);
        $check_pass_otp_row = mysqli_fetch_assoc($check_pass_otp_result);
        $check_pass_otp_nor = mysqli_num_rows($check_pass_otp_result);

        if($check_pass_otp_nor > 0){
            if($otp_get != $check_pass_otp_row['otp_no']){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>OTP Error : </strong> &nbsp; OTP Doesn't match.....!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }
            else{
                header("location:new_pass.php");
            }
        }else{
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>OTP Error : </strong> &nbsp; No recodes found.....!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
        }
    }

    function update_pass($update_username,$update_email,$update_pass,$update_cpass){
        $con = Connection();

        if(empty($update_username)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Username Error : </strong> &nbsp; Username Cannot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($update_email)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Email Error : </strong> &nbsp; Email Cannot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($update_pass)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Password Error : </strong> &nbsp; Password Cannot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($update_cpass)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Password Error : </strong> &nbsp;Confarm Password Cannot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if($update_pass != $update_cpass){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Password Error : </strong> &nbsp;Passwords not match.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }

        $check_reset_pass = "SELECT * FROM user_tbl WHERE u_username = '$update_username' && user_email = '$update_email' && user_status = 1 && is_pending = 0";
        $check_reset_pass_result = mysqli_query($con, $check_reset_pass);
        $check_reset_pass_row = mysqli_fetch_assoc($check_reset_pass_result);
        $check_reset_pass_nor = mysqli_num_rows($check_reset_pass_result);

        if($check_reset_pass_nor > 0){
            if($update_username != $check_reset_pass_row['u_username']){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Username Error : </strong> &nbsp;Username not match.....!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }
            elseif($update_email != $check_reset_pass_row['user_email']){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Email Error : </strong> &nbsp;Email not match.....!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }
            elseif(!filter_var($update_email, FILTER_VALIDATE_EMAIL)){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Email Error : </strong> &nbsp;Check Email.....!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }else{
                $update_data_pass = "UPDATE user_tbl SET user_pass = '$update_pass' WHERE user_email = '$update_email' && u_username = '$update_username'";
                $update_data_pass_result = mysqli_query($con, $update_data_pass);
              
                setcookie('resetPass',NULL,time()-5*60,'/');
                session_unset();
                session_destroy();
                header("location:login.php");
            }         
        }else{
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp;Recodes not Found.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";

        }
    }

    function user_id(){
        $con = Connection();

        $user_login_id = strval($_SESSION['LoginSession']);

        $user_login_data = "SELECT * FROM user_tbl WHERE user_email = '$user_login_id'";
        $user_login_data_result = mysqli_query($con, $user_login_data);
        $user_login_data_row = mysqli_fetch_assoc($user_login_data_result);

        echo $user_login_data_row['u_username'];
    }

    function count_members(){
        $con = Connection();

        $member_count = "SELECT * FROM user_tbl WHERE user_type = 'user'";
        $member_count_result = mysqli_query($con, $member_count);
        $member_count_nor = mysqli_num_rows($member_count_result);

        echo $member_count_nor;
    }

    function count_admins(){
        $con = Connection();

        $admin_count = "SELECT * FROM user_tbl WHERE user_type = 'admin'";
        $admin_count_result = mysqli_query($con, $admin_count);
        $admin_count_nor = mysqli_num_rows($admin_count_result);

        echo $admin_count_nor;
    }

    function any_user_data(){
        $con = Connection();

        $user_data = "SELECT * FROM user_tbl WHERE user_type = 'user'";
        $user_data_result = mysqli_query($con, $user_data);

        while($user_data_row = mysqli_fetch_assoc($user_data_result)){

            $user_data_view = "
                <tr>
                        <th scope='row'>".$user_data_row['id']."</th>
                        <td>".$user_data_row['u_username']."</td>
                        <td>".$user_data_row['user_email']."</td>
                        <td>".$user_data_row['fname']."</td>
                        <td>".$user_data_row['nic']."</td>";

                    if($user_data_row['user_status'] == 1){
                        $user_data_view .= "<td><h4><span class='badge badge-success'>Active</span></h4></td>";
                    }
                    elseif($user_data_row['user_status'] == 0){
                        $user_data_view .= "<td><h4><span class='badge badge-danger'>Deactive</span></h4></td>";
                    }
                    if($user_data_row['is_pending'] == 1){
                        $user_data_view .= "<td><h4><span class='badge badge-info'>Pending User</span></h4></td>";
                    }
                    elseif($user_data_row['is_pending'] == 0){
                        $user_data_view .= "<td><h4><span class='badge badge-success'>Activated User</span></h4></td>";
                    }                   

            $user_data_view .= "
                            <td><a href='user_edit.php?id=".$user_data_row['u_username']."'><button class='btn btn-primary'>Infor</button></a></td>
                        </tr>                      
                ";
                echo $user_data_view;
        }       
    }

    function get_user_data_edit(){
        $con = Connection();

        $id = $_GET['id'];

        $_SESSION['userUpdate'] = $id;


        $check_data = "SELECT * FROM user_tbl WHERE u_username = '$id'";
        $check_data_result = mysqli_query($con, $check_data);
        $check_data_row = mysqli_fetch_assoc($check_data_result);
        $check_data_nor = mysqli_num_rows($check_data_result);


          $user_data = "

                    <div class='user-edit-grid'>
                        <div class='item-user1'>
                            <span class='form-text'>Username:
                            <input type='text' class='form-control' value='".$check_data_row['u_username']."' disabled></span>
                        </div>
                        <div class='item-user2'>
                            <span class='form-text'>First Name:
                            <input type='text' class='form-control' value='".$check_data_row['fname']."' disabled></span>
                        </div>
                        <div class='item-user3'>
                            <span class='form-text'>Last Name:
                            <input type='text' class='form-control' value='".$check_data_row['lname']."' disabled></span>
                        </div>
                        <div class='item-user4'>
                            <span class='form-text'>Email:
                            <input type='text' class='form-control' value='".$check_data_row['user_email']."' disabled></span>
                        </div>
                        <div class='item-user5'>
                            <span class='form-text'>Address:
                            <textarea class='form-control' disabled>".$check_data_row['user_address']."</textarea></span>
                        </div>
                        <div class='item-user6'>
                            <span class='form-text'>Date Of Birth:
                            <input type='text' class='form-control' value='".$check_data_row['dob']."' disabled></span>
                        </div>
                        <div class='item-user7'>
                            <span class='form-text'>NIC No:
                            <input type='text' class='form-control' value='".$check_data_row['nic']."' disabled></span>
                        </div>
                        <div class='item-user8'>
                            <span class='form-text'>Mobile Number:
                            <input type='text' class='form-control' value='".$check_data_row['mobile_no']."' disabled></span>
                        </div>
                        <div class='item-user9'>
                            <span class='form-text'>Join Date:
                            <input type='text' class='form-control' value='".$check_data_row['join_date']."' disabled></span>
                        </div>
                        <div class='item-user10'>
                            <span class='form-text'>User Status:
                            ";

                            if($check_data_row['user_status'] == 1){
                                $user_data .="<h3><span class='badge badge-success'>Active</span></h3>
                                <form action='' method='POST'>
                                    <input type='hidden' name='to_deactive' value='0'>
                                    <input type='submit' value='Deactive' name='user_to_deactive' class='btn btn-danger btn-lg btn-block'>   
                                </form>
                                
                                ";
                            }elseif($check_data_row['user_status'] == 0){
                                $user_data .="<h3><span class='badge badge-danger'>Deactive</span></h3>
                                <form action='' method='POST'>
                                    <input type='hidden' name='to_active' value='1'>
                                    <input type='submit' value='Active' name='user_to_active' class='btn btn-success btn-lg btn-block'>   
                                </form>
                                ";
                            }

                            

                $user_data .="
                        </div>
                        <div class='item-user11'>
                            <span class='form-text'>Pending Status:";

                            if($check_data_row['is_pending'] == 1){
                                $user_data .="<h3><span class='badge badge-danger'>Pending</span></h3>
                                <form action='' method='POST'>
                                    <input type='hidden' name='to_pending' value='0'>
                                    <input type='submit' value='Activate' name='user_not_to_pending' class='btn btn-success btn-lg btn-block'>   
                                </form>";
                            }
                            if($check_data_row['is_pending'] == 0){
                                $user_data .="<h3><span class='badge badge-success'>Active</span></h3>
                                <form action='' method='POST'>
                                    <input type='hidden' name='not_pending' value='1'>
                                    <input type='submit' value='Deactivate' name='user_to_pending' class='btn btn-danger btn-lg btn-block'>   
                                </form>";
                            }

                $user_data .="                            
                        </div>
                    </div>

                    <a href='admin.php'><button class='btn btn-primary'>Back</button></a>
                        
                    
                
            ";

            echo $user_data;

    }

    function to_deactive_user($id){
        $con = Connection();

        $user_update_id = strval($_SESSION['userUpdate']);

        $user_update_status_1 = "UPDATE user_tbl SET user_status = '$id' WHERE u_username = '$user_update_id'";
        $user_update_status_1_result = mysqli_query($con, $user_update_status_1);

        $after_update = "SELECT * FROM user_tbl WHERE u_username = '$user_update_id'";
        $after_update_result = mysqli_query($con, $after_update);
        $after_update_row = mysqli_fetch_assoc($after_update_result);

        if($after_update_row['user_type'] == 'user'){
            header("location:members.php");
        }elseif($after_update_row['user_type'] == 'admin'){
            header("location:admins.php");
        }       

    }

    function to_active_user($id){
        $con = Connection();

        $user_update_id = strval($_SESSION['userUpdate']);

        $user_update_status_2 = "UPDATE user_tbl SET user_status = '$id' WHERE u_username = '$user_update_id'";
        $user_update_status_2_result = mysqli_query($con, $user_update_status_2);

        $after_update = "SELECT * FROM user_tbl WHERE u_username = '$user_update_id'";
        $after_update_result = mysqli_query($con, $after_update);
        $after_update_row = mysqli_fetch_assoc($after_update_result);

        if($after_update_row['user_type'] == 'user'){
            header("location:members.php");
        }elseif($after_update_row['user_type'] == 'admin'){
            header("location:admins.php");
        }  
    }

    function not_to_pending($id){
        $con = Connection();
        $user_update_id = strval($_SESSION['userUpdate']);

        $user_update_status_2 = "UPDATE user_tbl SET is_pending = '$id' WHERE u_username = '$user_update_id'";
        $user_update_status_2_result = mysqli_query($con, $user_update_status_2);

        $after_update = "SELECT * FROM user_tbl WHERE u_username = '$user_update_id'";
        $after_update_result = mysqli_query($con, $after_update);
        $after_update_row = mysqli_fetch_assoc($after_update_result);

        if($after_update_row['user_type'] == 'user'){
            header("location:members.php");
        }elseif($after_update_row['user_type'] == 'admin'){
            header("location:admins.php");
        }  
    }

    function to_pending($id){
        $con = Connection();
        $user_update_id = strval($_SESSION['userUpdate']);

        $user_update_status_2 = "UPDATE user_tbl SET is_pending = '$id' WHERE u_username = '$user_update_id'";
        $user_update_status_2_result = mysqli_query($con, $user_update_status_2);

        $after_update = "SELECT * FROM user_tbl WHERE u_username = '$user_update_id'";
        $after_update_result = mysqli_query($con, $after_update);
        $after_update_row = mysqli_fetch_assoc($after_update_result);

        if($after_update_row['user_type'] == 'user'){
            header("location:members.php");
        }elseif($after_update_row['user_type'] == 'admin'){
            header("location:admins.php");
        }  
    }

    function any_admin_data(){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $user_data = "SELECT * FROM user_tbl WHERE user_type = 'admin'";
        $user_data_result = mysqli_query($con, $user_data);

        $login_user_data = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $login_user_data_result = mysqli_query($con, $login_user_data);
        $login_user_data_row = mysqli_fetch_assoc($login_user_data_result);


        while($user_data_row = mysqli_fetch_assoc($user_data_result)){

            $user_data_view = "
                <tr>
                        <th scope='row'>".$user_data_row['id']."</th>
                        <td>".$user_data_row['u_username']."</td>
                        <td>".$user_data_row['user_email']."</td>
                        <td>".$user_data_row['fname']."</td>
                        <td>".$user_data_row['nic']."</td>";

                    if($user_data_row['user_status'] == 1){
                        $user_data_view .= "<td><h4><span class='badge badge-success'>Active</span></h4></td>";
                    }
                    elseif($user_data_row['user_status'] == 0){
                        $user_data_view .= "<td><h4><span class='badge badge-danger'>Deactive</span></h4></td>";
                    }
                    if($user_data_row['is_pending'] == 1){
                        $user_data_view .= "<td><h4><span class='badge badge-info'>Pending User</span></h4></td>";
                    }
                    elseif($user_data_row['is_pending'] == 0){
                        $user_data_view .= "<td><h4><span class='badge badge-success'>Activated User</span></h4></td>";
                    }                   

                    if($login_user_data_row['u_username'] == $user_data_row['u_username']){
                        $user_data_view .= "
                        <td><span style='color:red;'>Loged Admin</span></td>
                    </tr>";
                    }else{

            $user_data_view .= "
                            <td><a href='user_edit.php?id=".$user_data_row['u_username']."'><button class='btn btn-primary'>Infor</button></a></td>
                        </tr>                      
                ";
            }
                echo $user_data_view;
        }
    }
    function add_product($p_name, $p_price, $p_qty, $p_stock){
        $con = Connection();
        
        if(empty($p_name)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; Product Name Cannot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";

        }if(empty($p_price)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; Product Price Cannot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";

        }if(empty($p_qty)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; Product QTY Cannot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($p_stock)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; Product Stock Cannot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }

        $check_prodcuts = "SELECT * FROM shop WHERE p_name = '$p_name'";
        $check_prodcuts_result = mysqli_query($con, $check_prodcuts);
        $check_prodcuts_nor = mysqli_num_rows($check_prodcuts_result);

        if($check_prodcuts_nor > 0){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Error : </strong> &nbsp; Product Already in the Database.....!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";

        }else{
            $insert_product = "INSERT INTO shop(p_name,p_price,qty,is_stock,status,img_status,date)VALUES('$p_name','$p_price','$p_qty','$p_stock',1,0,NOW())";
            $insert_product_result = mysqli_query($con, $insert_product);
            header("location:products.php");
            
        }        
    }

    function all_products(){
        $con = Connection();

        $products = "SELECT * FROM shop";
        $products_result = mysqli_query($con, $products);

        while($products_row = mysqli_fetch_assoc($products_result)){
            $products_data = "
                <tr>
                    <th scope='row'>".$products_row['id']."</th>
                    <td>".$products_row['p_name']."</td>
                    <td>".$products_row['p_price']."</td>
                    <td>".$products_row['qty']."</td>";

                    if($products_row['is_stock'] > 0){
                        $products_data .= "<td><b>".$products_row['is_stock']."</b>&nbsp;<span style='color:green;'>(In Stock)</span></td>";
                    }
                    elseif($products_row['is_stock'] == 0){
                        $products_data .= "<td><b>".$products_row['is_stock']."</b>&nbsp;<span style='color:red;'>(Out of Stock)</span></td>";
                    }
                    if($products_row['status'] == 1){
                        $products_data .= "<td><h4><span class='badge badge-success'>Product Active</span></h4></td>";
                    }
                    elseif($products_row['status'] == 0){
                        $products_data .= "<td><h4><span class='badge badge-danger'>Product Deactive</span></h4></td>";
                    }
                    if($products_row['img_status'] == 1){
                        $products_data .= "<td><span style='color:green';>Image Set</span></td>";
                    }
                    elseif($products_row['img_status'] == 0){
                        $products_data .= "<td><span style='color:red';>Image Not Set</span></td>";
                    }

            $products_data .= "
                    <td>".$products_row['date']."</td>
                    <td><a href='edit_product.php?id=".$products_row['id']."'><button class='btn btn-primary'>Info</button></td>  
                    <td><a href='edit_product_img.php?id=".$products_row['id']."'><button class='btn btn-primary'>Image</button></td>         
                </tr>
            
            ";

            echo $products_data;
        }
    }

    function update_product_image($img){
        $con = Connection();

        $product_id = $_GET['id'];
        $image_dir = "../../upload/";
        
        $filename = basename($_FILES["images"]["name"]);
        $image_target_path = $image_dir . $filename;
        $filetype = pathinfo($image_target_path, PATHINFO_EXTENSION);

        $image_types = array('jpg','png','jpeg','gif','PNG');

        if(in_array($filetype, $image_types)){
            if(move_uploaded_file($_FILES["images"]["tmp_name"], $image_target_path)){
                $update_img = "UPDATE shop SET product_img = '$filename',img_status = 1 WHERE id = '$product_id'";
                $update_img_result = mysqli_query($con, $update_img); 

                header("location:products.php");
            }
        }
    }

    function count_products(){
        $con = Connection();

        $count_products = "SELECT * FROM shop";
        $count_products_result = mysqli_query($con, $count_products);
        $count_products_nor = mysqli_num_rows($count_products_result);

        echo $count_products_nor;
    }



    function update_product(){
        $con = Connection();

        $id = $_GET['id'];
        $_SESSION['productId'] = $id;

        $check_product = "SELECT * FROM shop WHERE id = '$id'";
        $check_product_result = mysqli_query($con, $check_product);
        $check_product_row = mysqli_fetch_assoc($check_product_result);
        $check_product_nor = mysqli_num_rows($check_product_result);

        if($check_product_nor > 0){
            $product_data = "
            <div style='padding-top:50px;'>
            <img src='../../upload/".$check_product_row['product_img']."' class='product-image' alt='p_img'>

                <form action='' method='POST'>     
                <div class='product-add-grid'>               
                        <div class='item-add1'>
                            <span>
                                Product Name :
                                <input type='text' name='update_pname' value='".$check_product_row['p_name']."' class='form-control'>
                            </span>
                        </div>
                        <div class='item-add2'>
                            <span>
                                Product Price :
                                <input type='number' name='update_pprice' value='".$check_product_row['p_price']."' class='form-control'>
                            </span>
                        </div>
                        <div class='item-add3'>
                            <span>
                                Product QTY :
                                <input type='number' name='update_pqty' value='".$check_product_row['qty']."' class='form-control'>
                            </span>
                        </div>
                        <div class='item-add4'>
                            <span>
                                Product Stock :
                                <input type='number' name='update_pstock' value='".$check_product_row['is_stock']."' class='form-control'>
                            </span>
                        </div>
                        <div class='item-add5'>
                            <span>
                                <input type='submit' name='update_product_info' value='Update Product Info' class='btn btn-success btn-lg btn-block'>
                            </span>
                        </div>    
                        </div>                 
                    </form>                   
                </div>

                <div style='padding-top:30px'>";
                    if($check_product_row['status'] == 1){
                        $product_data .="
                            Product Status : 
                            <h3><span class='badge badge-success'>Active</span></h3>
                            <form action='' method='POST'>
                                <input type='hidden' name='product_deactive' value='0'>
                                <input type='submit' name='product_status_deactive' value='Deactive' class='btn btn-danger'>
                            </form>";
                    }elseif($check_product_row['status'] == 0){
                        $product_data .="
                            Product Status : 
                            <h3><span class='badge badge-danger'>Deactive</span></h3>
                            <form action='' method='POST'>
                                <input type='hidden' name='product_active' value='1'>
                                <input type='submit' name='product_status_active' value='Deactive' class='btn btn-success'>
                            </form>";
                    }



            $product_data .="<br><br>
                    <a href='products.php'><button class='btn btn-primary'>Back</button></a>
                </div>
            ";

            echo $product_data;
        }else{
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; Data Not Found.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
    }

    function update_product_data($pname, $pprice, $pqty, $pstock){
        $con = Connection();

        $product_id = strval($_SESSION['productId']);

        $update_product = "UPDATE shop SET p_name = '$pname', p_price = '$pprice', qty = '$pqty', is_stock = '$pstock' WHERE id = '$product_id'";
        $update_product_result = mysqli_query($con, $update_product);

        header("location:products.php");
        
    }

    function product_deactive($id){
        $con = Connection();

        $product_id = strval($_SESSION['productId']);

        $update_product_status_1 = "UPDATE shop SET status = '$id' WHERE id = '$product_id'";
        $update_product_status_1_result = mysqli_query($con, $update_product_status_1);
        header("location:products.php");
    }

    
    function product_active($id){
        $con = Connection();

        $product_id = strval($_SESSION['productId']);

        $update_product_status_1 = "UPDATE shop SET status = '$id' WHERE id = '$product_id'";
        $update_product_status_1_result = mysqli_query($con, $update_product_status_1);
        header("location:products.php");
    }

    function update_product_img(){
        $con = Connection();

        $id = $_GET['id'];
        $check_img = "SELECT * FROM shop WHERE id = '$id'";
        $check_img_result = mysqli_query($con, $check_img);
        $check_img_row = mysqli_fetch_assoc($check_img_result);
        

        $view_img = "
            <img src='../../upload/".$check_img_row['product_img']."' alt='Profile Image' class='product-image'>
        
            <form action='' method='POST' enctype='multipart/form-data'>
                <input type='file' name='images' class='form-control' style='margin-bottom:20px;'>
                <input type='submit' name='product_img_update' value='Update Prodcut Image' class='btn btn-success btn-lg btn-block'>      
            </form>


            <a href='products.php'><button class='btn btn-primary' style='margin-top:30px;'>Back</button></a>
        ";

        echo $view_img;
        
    }

    function all_products_view(){
        $con = Connection();

        $select_all_products = "SELECT * FROM shop";
        $select_all_products_result = mysqli_query($con, $select_all_products);
        
        while($product_row = mysqli_fetch_assoc($select_all_products_result)){
            $product_row_view ="
                <div class='p-item'>
                    <center><img src='../../upload/".$product_row['product_img']."' class='supp-img'></center>
                    <div class='p-infor'>
                        <div class='p-name'>".$product_row['p_name']."</div>
                        <div class='qty'>".$product_row['qty']."</div>
                        <div class='p-price'>".$product_row['p_price']."</div>
                    </div>
                </div>
                           
            ";

            echo $product_row_view;
        }
    }
    function all_products_view_login(){
        $con = Connection();

        $select_all_products = "SELECT * FROM shop";
        $select_all_products_result = mysqli_query($con, $select_all_products);
        
        while($product_row = mysqli_fetch_assoc($select_all_products_result)){
            $product_row_view ="
                <div class='p-item'>
                    <center><img src='../upload/".$product_row['product_img']."' class='supp-img'></center>
                    <div class='p-infor'>
                        <div class='p-name'>".$product_row['p_name']."</div>
                        <div class='qty'>".$product_row['qty']."</div>
                        <div class='p-price'>".$product_row['p_price']."</div>
                    </div>
                </div>
                           
            ";

            echo $product_row_view;
        }
    }

    function all_plans(){
        $con = Connection();

        $all_plans = "SELECT * FROM plan_tbl";
        $all_plans_result = mysqli_query($con, $all_plans); 
        

        while($all_plans_row = mysqli_fetch_assoc($all_plans_result)){
            $all_planes_view = "
                <tr>
                    <th scope='row'>".$all_plans_row['id']."</th>
                    <td>".$all_plans_row['plan_name']."</td>
                    <td>".$all_plans_row['20p']."</td>
                    <td>".$all_plans_row['40p']."</td>
                    <td>".$all_plans_row['60p']."</td>
                    <td>".$all_plans_row['80p']."</td>
                    <td>".$all_plans_row['100p']."</td>"; 

                    if($all_plans_row['plan_status'] == 1){
                        $all_planes_view .= "<td><h4><span class='badge badge-success'>Plan Active</span></h4></td>";
                    }elseif($all_plans_row['plan_status'] == 0){
                        $all_planes_view .= "<td><h4><span class='badge badge-danger'>Plan Deactive</span></h4></td>";
                    }

            $all_planes_view .="
                    <td>".$all_plans_row['add_date']."</td>
                    <td><a href='edit_plan.php?id=".$all_plans_row['id']."'><button class='btn btn-primary'>Info</button></td>
                </tr>
            ";

            echo $all_planes_view;
        }
    }

    function edit_plan(){
        $con = Connection();

        $id = $_GET['id'];
        $_SESSION['planId'] = $id;

        $check_plan = "SELECT * FROM plan_tbl WHERE id= '$id'";
        $check_plan_result = mysqli_query($con, $check_plan);
        $check_plan_row = mysqli_fetch_assoc($check_plan_result);

        $plan_data = "
            <form action='' method='POST'>
                Plan Name : 
                <input type='text' name='update_plan_name' class='form-control' value='".$check_plan_row['plan_name']."'>
                <br>
                20% Completed :
                <input type='text' name='u20p' class='form-control' value='".$check_plan_row['20p']."' >
                <br>
                40% Completed :
                <input type='text' name='u40p' class='form-control' value='".$check_plan_row['40p']."' >
                <br>
                60% Completed :
                <input type='text' name='u60p' class='form-control' value='".$check_plan_row['60p']."' >
                <br>
                80% Completed :
                <input type='text' name='u80p' class='form-control' value='".$check_plan_row['80p']."' >
                <br>
                100% Completed :
                <input type='text' name='u100p' class='form-control' value='".$check_plan_row['100p']."' >
                <br>
                <input type='submit' name='update_plan_data' value='Update Plane' class='btn btn-success btn-lg btn-block'>                
            </form>

            <br><br>
            Plan Status : ";

            if($check_plan_row['plan_status'] == 1){
                $plan_data .="
                    <h3><span class='badge badge-success'>Plane Active</span></h3>
                    <form action='' method='POST'>
                        <input type='hidden' name='deactive_plane' value='0'>
                        <input type='submit' name='deactive_place_data' value='Deactive Plan' class='btn btn-danger'>
                    </form>
                
                ";
            }elseif($check_plan_row['plan_status'] == 0){
                $plan_data .="
                    <h3><span class='badge badge-danger'>Plane Deative</span></h3>
                    <form action='' method='POST'>
                        <input type='hidden' name='active_plane' value='1'>
                        <input type='submit' name='active_place_data' value='Deactive Plan' class='btn btn-success'>
                    </form>
                ";
            }  
            $plan_data .="
            <br><br><br><br>
                <a href='plans.php'><button class='btn btn-primary'>Back</button></a>
            ";    


        echo $plan_data;
    }

    function update_plan_infor($plan_name,$p20u,$p40u,$p60u,$p80u,$p100u){
        $con = Connection();

        $plan_id = strval($_SESSION['planId']);

        $update_plan_info = "UPDATE plan_tbl SET plan_name ='$plan_name', 20p = '$p20u', 40p = '$p40u', 60p = '$p60u', 80p = '$p80u', 100p = '$p100u' WHERE id = '$plan_id'";
        $update_plan_info_result = mysqli_query($con, $update_plan_info);

        header("location:plans.php");
    }

    function plan_deactive($id){
        $con = Connection();
        $plan_id = strval($_SESSION['planId']);

        $update_plan = "UPDATE plan_tbl SET plan_status = '$id' WHERE id = '$plan_id'";
        $update_plan_result = mysqli_query($con, $update_plan);

        header("location:plans.php");
    }

    function plan_active($id){
        $con = Connection();
        $plan_id = strval($_SESSION['planId']);

        $update_plan = "UPDATE plan_tbl SET plan_status = '$id' WHERE id = '$plan_id'";
        $update_plan_result = mysqli_query($con, $update_plan);
        header("location:plans.php");
    }

    function add_plan($plan_name,$p20,$p40,$p60,$p80,$p100){
        $con = Connection();

        if(empty($plan_name)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; Plan Name Connot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($p20)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; 20% Completed Connot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($p40)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; 20% Completed Connot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($p60)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; 20% Completed Connot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($p80)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; 20% Completed Connot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if(empty($p100)){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; 20% Completed Connot be empty.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        else{
            $check_plan = "SELECT * FROM plan_tbl WHERE plan_name = '$plan_name'";
            $check_plan_result = mysqli_query($con, $check_plan);
            $check_plan_nor = mysqli_num_rows($check_plan_result);

            if($check_plan_nor > 0){
                return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Error : </strong> &nbsp; Plan already exists.....!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
            }
            else{
                $plan_insert = "INSERT INTO plan_tbl(plan_name,20p,40p,60p,80p,100p,plan_status,add_date)VALUES('$plan_name','$p20','$p40','$p60','$p80','$p100',1,NOW())";
                $plan_insert_result = mysqli_query($con, $plan_insert);

                header("location:plans.php");
            }
        }        
    }

    function count_plans(){
        $con = Connection();

        $count_plans = "SELECT * FROM plan_tbl";
        $count_plans_result = mysqli_query($con, $count_plans);
        $count_plans_nor = mysqli_num_rows($count_plans_result);

        echo $count_plans_nor;
    }

    function profile_img(){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $view_profile_img = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $view_profile_img_result = mysqli_query($con, $view_profile_img);
        $view_profile_img_row = mysqli_fetch_assoc($view_profile_img_result);

        $profile_img_view ="
        <img src='../../upload/".$view_profile_img_row['profile_img']."' alt='Profile Image' class='profile-img'>
        ";

        echo $profile_img_view;
    }

    function user_id_loged(){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $select_usern = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $select_usern_result = mysqli_query($con, $select_usern);
        $select_usern_row = mysqli_fetch_assoc($select_usern_result);

        echo $select_usern_row['u_username'];
    }

    function profile_info(){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $select_loged_user_data = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $select_loged_user_data_result = mysqli_query($con, $select_loged_user_data);
        $select_loged_user_data_row = mysqli_fetch_assoc($select_loged_user_data_result);
    
        $login_user_data = "
            <img src='../../upload/".$select_loged_user_data_row['profile_img']."' alt='Profile Image' class='profile-edit-img'><br>
            <a href='update_pimg.php?id=".$login_user."'><button class='btn btn-primary' style='margin-bottom:20px;'>Update Profile Image</button></a>
            <hr>

            <div class='update-profile-info'>
                <div class='profile-infor-grid'>
                    <div class='p-item1'>
                        Username : 
                        <input type='text' value='".$select_loged_user_data_row['u_username']."' class='form-control' disabled>
                    </div>
                    <div class='p-item2'>
                        First Name : 
                        <input type='text' value='".$select_loged_user_data_row['fname']."' class='form-control' disabled>
                    </div>
                    <div class='p-item3'>
                        Last Name : 
                        <input type='text' value='".$select_loged_user_data_row['lname']."' class='form-control' disabled>
                    </div>
                    <div class='p-item4'>
                        User Email : 
                        <input type='text' value='".$select_loged_user_data_row['user_email']."' class='form-control' disabled>
                    </div>
                    <div class='p-item5'>
                        User Address : 
                        <textarea class='form-control' rows='5' style='resize:none;' disabled>".$select_loged_user_data_row['user_address']."</textarea>
                    </div>
                    <div class='p-item6'>
                        Date of Birth : 
                        <input type='text' value='".$select_loged_user_data_row['dob']."' class='form-control' disabled>
                    </div>
                    <div class='p-item7'>
                        NIC/Passport No : 
                        <input type='text' value='".$select_loged_user_data_row['nic']."' class='form-control' disabled>
                    </div>
                    <div class='p-item8'>
                        Mobile Number : 
                        <input type='text' value='".$select_loged_user_data_row['mobile_no']."' class='form-control' disabled>
                    </div>
                    <div class='p-item9'>
                        User Type : ";

                        if($select_loged_user_data_row['user_type'] == 'admin'){
                            $login_user_data  .="<span><h3><span class='badge badge-warning'><i class='fas fa-user-tie'></i>&nbsp;Admin Account</span></h3></span>";
                        }
                        elseif($select_loged_user_data_row['user_type'] == 'user'){
                            $login_user_data  .="<span><h3><span class='badge badge-info'><i class='fas fa-user-alt'></i>&nbsp;User Account</span></h3></span>";
                        }
                        
                $login_user_data  .="</div>
                    <div class='p-item10'>
                        Join Date : 
                        <input type='text' value='".$select_loged_user_data_row['join_date']."' class='form-control' disabled>
                    </div>
                    <div class='p-item11'>
                        Account Status : ";

                        if($select_loged_user_data_row['user_status'] == 1){
                            $login_user_data  .="<span><h3><span class='badge badge-success'>Active Account</span></h3></span>";
                        }
                        elseif($select_loged_user_data_row['user_status'] == 0){
                            $login_user_data  .="<span><h3><span class='badge badge-info'>Deactive Account</span></h3></span>";
                        }

                        
            $login_user_data  .="         
                    </div>
                    <div class='p-item12'>
                        <a href='update_profile.php?id=".$login_user."'><button class='btn btn-primary btn-lg btn-block' style='margin-bottom:20px; text-decoration:none;'>Update Profile</button></a>
                    </div>
                </div>
            </div>
        ";

        echo $login_user_data;
    }

    function update_profile_img(){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $select_profile = "SELECT* FROM user_tbl WHERE user_email = '$login_user'";
        $select_profile_result = mysqli_query($con, $select_profile);
        $select_profile_row = mysqli_fetch_assoc($select_profile_result);

        $view_form = "
            <img src='../../upload/".$select_profile_row['profile_img']."' alt='Profile Image' class='profile-edit-img'>
            
            <form action='' method='POST' enctype='multipart/form-data'>
                New Profile Image
                <input type='file' name='images' class='form-control' style='margin-bottom:20px;'>
                <input type='submit' name='profile_img_update' value='Update Profile Image' class='btn btn-success btn-lg btn-block'>      
            </form>";

            if($select_profile_row['user_type'] == 'admin'){
                $view_form .="<a href='my_account_admin.php'><button class='btn btn-primary' style='margin-top:30px;'>Back</button></a>";
            }elseif($select_profile_row['user_type'] == 'user'){
                $view_form .="<a href='user.php'><button class='btn btn-primary' style='margin-top:30px;'>Back</button></a>";
            }          
        
        echo $view_form;
        
    }

    function update_profile_image($img){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $check_user = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $check_user_result = mysqli_query($con, $check_user);
        $check_user_row = mysqli_fetch_assoc($check_user_result);


        $image_dir = "../../upload/";
        
        $filename = basename($_FILES["images"]["name"]);
        $image_target_path = $image_dir . $filename;
        $filetype = pathinfo($image_target_path, PATHINFO_EXTENSION);

        $image_types = array('jpg','png','jpeg','gif','PNG');

        if(in_array($filetype, $image_types)){
            if(move_uploaded_file($_FILES["images"]["tmp_name"], $image_target_path)){
                $update_img = "UPDATE user_tbl SET profile_img = '$filename' WHERE user_email = '$login_user'";
                $update_img_result = mysqli_query($con, $update_img); 

                if($check_user_row['user_type'] == 'admin'){
                    header("location:my_account_admin.php");
                }elseif($check_user_row['user_type'] == 'user'){
                    header("location:user.php");
                }             
            }
        }
    }

    function update_profile_data(){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $select_data = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $select_data_result = mysqli_query($con, $select_data);
        $select_data_row = mysqli_fetch_assoc($select_data_result);

        $update_data = "
            <form action='' method='POST'>
                <div class='update-profile-info'>
                    <div class='profile-infor-grid'>
                        <div class='p-item1'>
                            Username : 
                            <input type='text' value='".$select_data_row['u_username']."' name='update_username' class='form-control' >
                        </div>
                        <div class='p-item2'>
                            First Name : 
                            <input type='text' value='".$select_data_row['fname']."' name='update_fname' class='form-control' >
                        </div>
                        <div class='p-item3'>
                            Last Name : 
                            <input type='text' value='".$select_data_row['lname']."' name='update_lname' class='form-control' >
                        </div>
                        <div class='p-item4'>
                            User Email : 
                            <input type='text' value='".$select_data_row['user_email']."' class='form-control' disabled>
                        </div>
                        <div class='p-item5'>
                            User Address : 
                            <textarea class='form-control' rows='5' style='resize:none;' name='update_address'>".$select_data_row['user_address']."</textarea>
                        </div>
                        <div class='p-item6'>
                            Date of Birth : 
                            <input type='date' value='".$select_data_row['dob']."' name='update_dob' class='form-control' >
                        </div>
                        <div class='p-item7'>
                            NIC/Passport No : 
                            <input type='text' value='".$select_data_row['nic']."' name='update_nic' class='form-control' >
                        </div>
                        <div class='p-item8'>
                            Mobile Number : 
                            <input type='text' value='".$select_data_row['mobile_no']."' name='update_mobile' class='form-control' >
                        </div>
                        <div class='p-item9'>
                        User Type : ";

                        if($select_data_row['user_type'] == 'admin'){
                            $update_data  .="<span><h3><span class='badge badge-warning'><i class='fas fa-user-tie'></i>&nbsp;Admin Account</span></h3></span>";
                        }
                        elseif($select_data_row['user_type'] == 'user'){
                            $update_data  .="<span><h3><span class='badge badge-info'><i class='fas fa-user-alt'></i>&nbsp;User Account</span></h3></span>";
                        }
                        
                $update_data  .="</div>
                <div class='p-item10'>
                    Join Date : 
                    <input type='text' value='".$select_data_row['join_date']."' class='form-control' disabled>
                </div>
                <div class='p-item11'>
                    Account Status : ";

                    if($select_data_row['user_status'] == 1){
                        $update_data  .="<span><h3><span class='badge badge-success'>Active Account</span></h3></span>";
                    }
                    elseif($select_data_row['user_status'] == 0){
                        $update_data  .="<span><h3><span class='badge badge-info'>Deactive Account</span></h3></span>";
                    }

            $update_data  .="</div>
                </div>
                <div class='p-item12'>
                    <input type='submit' name='update_profile_info' value='Update Profile Data' class='btn btn-success btn-lg btn-block'>
                </div>
                </div>
            </form>";

            if($select_data_row['user_type'] == 'admin'){
                $update_data .="<a href='my_account_admin.php'><button class='btn btn-primary' style='margin-top:30px;'>Back</button></a>";
            }elseif($select_data_row['user_type'] == 'user'){
                $update_data .="<a href='user.php'><button class='btn btn-primary' style='margin-top:30px;'>Back</button></a>";
            }   

        echo $update_data;
    }

    function data_update_profile($update_username, $update_fname, $update_lname, $update_address, $update_dob, $update_nic, $update_mobile){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $update_user = "UPDATE user_tbl SET u_username = '$update_username', fname = '$update_fname', lname = '$update_lname', user_address = '$update_address', dob = '$update_dob', nic = '$update_nic', mobile_no = '$update_mobile' WHERE user_email = '$login_user'";
        $update_user_result = mysqli_query($con, $update_user);

        header("location:../views/logout.php");
    }

    function all_product_back_btn(){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);

        $select_user = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $select_user_result = mysqli_query($con, $select_user);
        $select_user_row = mysqli_fetch_assoc($select_user_result);

        if($select_user_row['user_type'] == 'admin'){
            echo "<a href='products.php'><button class='btn btn-primary'>Back</button></a>";
        }elseif($select_user_row['user_type'] == 'user'){
            echo "<a href='user.php'><button class='btn btn-primary'>Back</button></a>";
        }
    }
    function all_plans_view(){
        $con = Connection();

        $select_all_plan = "SELECT * FROM plan_tbl";
        $select_all_plan_result = mysqli_query($con, $select_all_plan);
        
        while($plan_row = mysqli_fetch_assoc($select_all_plan_result)){
            $plan_row_view ="
                <div class='p-item'>
                    <div class='p-infor'>
                        <div class='p-name'>".$plan_row['plan_name']."</div>
                        <div>".$plan_row['20p']."</div>
                        <div>".$plan_row['40p']."</div>
                        <div>".$plan_row['60p']."</div>
                        <div>".$plan_row['80p']."</div>
                        <div>".$plan_row['100p']."</div>

                        <form action='' method='POST'>
                            <input type='hidden' name='active_plan_user_id' value='1'>
                            <input type='hidden' name='plan_name' value='".$plan_row['plan_name']."'>
                            <input type='submit' name='active_a_plan' class='btn btn-primary' value='Active' style='margin-top:15px'>
                        </form>
                    </div>
                </div>                           
            ";

            echo $plan_row_view;
        }
    }

    function active_plan_user($id, $pname){
        $con = Connection();
        $login_user = strval($_SESSION['LoginSession']);

        $select_data = "SELECT * FROM user_tbl WHERE user_email = '$login_user' && plan_name='$pname'";
        $select_data_result = mysqli_query($con, $select_data);
        $select_data_row = mysqli_fetch_assoc($select_data_result);
        $select_data_nor = mysqli_num_rows($select_data_result);

        $select_data_back = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $select_data_back_result = mysqli_query($con, $select_data_back);
        $select_data_back_row = mysqli_fetch_assoc($select_data_back_result);

        if($select_data_nor > 0){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; User already Active this plan.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        if($select_data_back_row['any_plan'] == 1){
            return  "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong>Error : </strong> &nbsp; User already Active a plan.....!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }        
        else{
            $update_user_tbl = "UPDATE user_tbl SET plan_name ='$pname', any_plan = 1 WHERE user_email = '$login_user'";
            $update_user_tbl_result = mysqli_query($con, $update_user_tbl);

            $insert_plan_active = "INSERT INTO user_plan_tbl(user_email,plan_name,active_date,last_update_date,is_completed)VALUES('$login_user','$pname',NOW(),NOW(),0)";
            $insert_plan_active_result = mysqli_query($con, $insert_plan_active);
            


            if($select_data_back_row['user_type'] == 'admin'){
                header("location:my_account_admin.php");
            }elseif($select_data_back_row['user_type'] == 'user'){
                header("location:user.php");
            }
        }
    }

    function plan_data(){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);


        $plan_data = "SELECT * FROM user_tbl WHERE user_email = '$login_user'";
        $plan_data_result = mysqli_query($con, $plan_data);
        $plan_data_row = mysqli_fetch_assoc($plan_data_result);

        $pname = $plan_data_row['plan_name'];

        $plan_data_plan = "SELECT * FROM plan_tbl WHERE plan_name = '$pname'";
        $plan_data_plan_result = mysqli_query($con, $plan_data_plan);
        $plan_data_plan_row = mysqli_fetch_assoc($plan_data_plan_result);

        $plan_data_tbl = "SELECT * FROM user_plan_tbl WHERE user_email  = '$login_user'";
        $plan_data_tbl_result = mysqli_query($con, $plan_data_tbl);
        $plan_data_tbl_row = mysqli_fetch_assoc($plan_data_tbl_result);
        $plan_data_tbl_nor = mysqli_num_rows($plan_data_tbl_result);

        if($plan_data_tbl_nor > 0){
            $plan_view = "
                <div class='my-plan'>
                    <div class='title'>".$plan_data_tbl_row['plan_name']."</div>
                    <hr>";
                if($plan_data_tbl_row['20p'] == 0){
                        $plan_view .= "
                            <div class='complete-plan'>
                                <div class='text'>
                                    0%
                                </div>
                            </div> ";
                    }
                if($plan_data_tbl_row['20p'] == 1 && $plan_data_tbl_row['40p'] == 0){
                    $plan_view .= "
                        <div class='complete-plan20'>
                            <div class='text'>
                                20%
                            </div>
                        </div> ";
                }if($plan_data_tbl_row['40p'] == 1 && $plan_data_tbl_row['60p'] == 0){
                    $plan_view .= "
                        <div class='complete-plan40'>
                            <div class='text'>
                                40%
                            </div>
                        </div> ";
                }if($plan_data_tbl_row['60p'] == 1 && $plan_data_tbl_row['80p'] == 0){
                    $plan_view .= "
                        <div class='complete-plan60'>
                            <div class='text'>
                                60%
                            </div>
                        </div> ";
                }if($plan_data_tbl_row['80p'] == 1 && $plan_data_tbl_row['100p'] == 0){
                    $plan_view .= "
                        <div class='complete-plan80'>
                            <div class='text'>
                                80%
                            </div>
                        </div> ";
                }if($plan_data_tbl_row['100p'] == 1){
                    $plan_view .= "
                        <div class='complete-plan100'>
                            <div class='text'>
                                100%
                            </div>                            
                        </div> 
                        <div style='text-align:center; padding-top:15px;'>
                            <form action='' method='POST'>
                                <input type='hidden' name='complete_plan' value='0'>
                                <input type='submit' name='plan_complete' value='Complete Plan' class='btn btn-success'>
                            </form>
                        </div>";
                }
            

                $plan_view .= "</div>
                    <a href='view_my_plan.php?id=".$login_user."'><button class='btn btn-primary' style='margin-top:20px;'>View My Plan</button></a>
                ";
                echo $plan_view;
        }
        else{
            echo "<span style='color:red;'>No Plan Select</span>";
        }

       
    }

    function view_activities_my_plan(){
        $con = Connection();
        $login_user = strval($_SESSION['LoginSession']);        

        $select_my_activities = "SELECT * FROM user_plan_tbl WHERE user_email  = '$login_user'";
        $select_my_activities_result = mysqli_query($con, $select_my_activities);
        $select_my_activities_row = mysqli_fetch_assoc($select_my_activities_result);

        $plan_name = $select_my_activities_row['plan_name'];

        $select_my_plan = "SELECT * FROM plan_tbl WHERE plan_name  = '$plan_name'";
        $select_my_plan_result = mysqli_query($con, $select_my_plan);
        $select_my_plan_row = mysqli_fetch_assoc($select_my_plan_result);

        $my_activities = "
            <a href='user.php'><button class='btn btn-primary' style='margin-bottom:50px;'>Back</button></a>
            <div>
                Plan Name : ".$select_my_activities_row['plan_name']."
                <br><br>
                <table class='table'>
                    <thead class='thead-dark'>
                        <tr>
                        <th scope='col'>Activity</th>
                        <th scope='col'>Doing</th>
                        <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Activity 01</td>
                                <td>".$select_my_plan_row['20p']."</td>
                                <td>
                                <form action='' method='POST'>
                                    <input type='hidden' name='u20p' value='1'>";
                                    if($select_my_activities_row['20p'] == 0){
                                        $my_activities .="<input type='submit' name='up20' value='Done' class='btn btn-success'>";
                                    }elseif($select_my_activities_row['20p'] == 1){
                                        $my_activities .="<span style='color:green;'>Done</span>";
                                    }

                $my_activities .="</form>                       
                            </td>                    
                        </tr>
                        <tr>
                            <td>Activity 02</td>
                            <td>".$select_my_plan_row['40p']."</td>
                            <td>
                                <form action='' method='POST'>
                                    <input type='hidden' name='u40p' value='1'>";
                                    if($select_my_activities_row['20p'] == 1 && $select_my_activities_row['40p'] == 0){
                                        $my_activities .="<input type='submit' name='up40' value='Done' class='btn btn-success'>";
                                    }if($select_my_activities_row['20p'] == 0){
                                        $my_activities .="<span style='color:red;'>Complete Previous Activities</span>";
                                    }if($select_my_activities_row['40p'] == 1){
                                        $my_activities .="<span style='color:green;'>Done</span>";
                                    }

                                    
                     $my_activities .="</form>
                            </td>
                        </tr>
                        <tr>
                            <td>Activity 03</td>
                            <td>".$select_my_plan_row['60p']."</td>
                            <td>
                                <form action='' method='POST'>
                                    <input type='hidden' name='u60p' value='1'>";

                                    if($select_my_activities_row['40p'] == 1 && $select_my_activities_row['60p'] == 0){
                                        $my_activities .="<input type='submit' name='up60' value='Done' class='btn btn-success'>";
                                    }if($select_my_activities_row['40p'] == 0){
                                        $my_activities .="<span style='color:red;'>Complete Previous Activities</span>";
                                    }if($select_my_activities_row['60p'] == 1){
                                        $my_activities .="<span style='color:green;'>Done</span>";
                                    }

                    $my_activities .="</form>
                            </td>
                        </tr>
                        <tr>
                            <td>Activity 04</td>
                            <td>".$select_my_plan_row['80p']."</td>
                            <td>
                                <form action='' method='POST'>
                                    <input type='hidden' name='u80p' value='1'>";

                                    if($select_my_activities_row['60p'] == 1 && $select_my_activities_row['80p'] == 0){
                                        $my_activities .="<input type='submit' name='up80' value='Done' class='btn btn-success'>";
                                    }if($select_my_activities_row['60p'] == 0){
                                        $my_activities .="<span style='color:red;'>Complete Previous Activities</span>";
                                    }if($select_my_activities_row['80p'] == 1){
                                        $my_activities .="<span style='color:green;'>Done</span>";
                                    }

                    $my_activities .="</form>
                            </td>
                        </tr>
                        <tr>
                            <td>Activity 05</td>
                            <td>".$select_my_plan_row['100p']."</td>
                            <td>
                                <form action='' method='POST'>
                                    <input type='hidden' name='u100p' value='1'>";

                                    if($select_my_activities_row['80p'] == 1 && $select_my_activities_row['100p'] == 0){
                                        $my_activities .="<input type='submit' name='up100' value='Done' class='btn btn-success'>";
                                    }if($select_my_activities_row['80p'] == 0){
                                        $my_activities .="<span style='color:red;'>Complete Previous Activities</span>";
                                    }if($select_my_activities_row['100p'] == 1){
                                        $my_activities .="<span style='color:green;'>Done</span>";
                                    }

                    $my_activities .="</form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
                                
            <div style='margin-top:60px;'>
                Activity Progress";
                
                if($select_my_activities_row['20p'] == 0){
                    $my_activities .=" <div class='progress'>
                        <div class='progress-bar' role='progressbar' style='width: 0%;' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>0%</div>
                    </div>";
                }if($select_my_activities_row['20p'] == 1 && $select_my_activities_row['40p'] == 0){
                    $my_activities .=" <div class='progress'>
                        <div class='progress-bar bg-danger' role='progressbar' style='width: 20%;' aria-valuenow='20' aria-valuemin='0' aria-valuemax='100'>20%</div>
                    </div>";
                }if($select_my_activities_row['40p'] == 1 && $select_my_activities_row['60p'] == 0){
                    $my_activities .=" <div class='progress'>
                        <div class='progress-bar bg-warning' role='progressbar' style='width: 40%;' aria-valuenow='40' aria-valuemin='0' aria-valuemax='100'>40%</div>
                    </div>";
                }if($select_my_activities_row['60p'] == 1 && $select_my_activities_row['80p'] == 0){
                    $my_activities .=" <div class='progress'>
                        <div class='progress-bar bg-info' role='progressbar' style='width: 60%;' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100'>60%</div>
                    </div>";
                }if($select_my_activities_row['80p'] == 1 && $select_my_activities_row['100p'] == 0){
                    $my_activities .=" <div class='progress'>
                        <div class='progress-bar bg-primary' role='progressbar' style='width: 80%;' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100'>80%</div>
                    </div>";
                }if($select_my_activities_row['100p'] == 1){
                    $my_activities .=" <div class='progress'>
                        <div class='progress-bar bg-success' role='progressbar' style='width: 100%;' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'>100%</div>
                    </div>
                    
                    <div style='margin-top:50px;'>
                        <p style='color:green; font-size:20px;'>You Successfully Compleated This Activity</p>
                    </div>
                    ";
                }                               

            $my_activities .="
            </div>
        ";

        echo $my_activities;
    }

    function update_20p($u20p){
        $con = Connection();
        $login_user = strval($_SESSION['LoginSession']);   

        $update_user_plan = "UPDATE user_plan_tbl SET 20p = '$u20p' WHERE user_email = '$login_user'";
        $update_user_plan = mysqli_query($con, $update_user_plan);

    }
    function update_40p($u40p){
        $con = Connection();
        $login_user = strval($_SESSION['LoginSession']);   

        $update_user_plan = "UPDATE user_plan_tbl SET 40p = '$u40p' WHERE user_email = '$login_user'";
        $update_user_plan = mysqli_query($con, $update_user_plan);
    }
    function update_60p($u60p){
        $con = Connection();
        $login_user = strval($_SESSION['LoginSession']);   

        $update_user_plan = "UPDATE user_plan_tbl SET 60p = '$u60p' WHERE user_email = '$login_user'";
        $update_user_plan = mysqli_query($con, $update_user_plan);
    }
    function update_80p($u80p){
        $con = Connection();
        $login_user = strval($_SESSION['LoginSession']);   

        $update_user_plan = "UPDATE user_plan_tbl SET 80p = '$u80p' WHERE user_email = '$login_user'";
        $update_user_plan = mysqli_query($con, $update_user_plan);
    }
    function update_100p($u100p){
        $con = Connection();
        $login_user = strval($_SESSION['LoginSession']);   

        $update_user_plan = "UPDATE user_plan_tbl SET 100p = '$u100p', is_completed = 1 WHERE user_email = '$login_user'";
        $update_user_plan = mysqli_query($con, $update_user_plan);
    }

    function plan_complete_user($id){
        $con = Connection();

        $login_user = strval($_SESSION['LoginSession']);   

        $update_user_tbl = "UPDATE user_tbl SET plan_name = '', any_plan = '$id' WHERE user_email = '$login_user'";
        $update_user_tbl_result = mysqli_query($con, $update_user_tbl);

        $delete_user_plan_tbl = "DELETE FROM user_plan_tbl WHERE user_email ='$login_user'";
        $delete_user_plan_tbl_result = mysqli_query($con, $delete_user_plan_tbl);

        return  "<br><br>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Plan Complete : </strong> &nbsp; The Plan Successfully Completed.....!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
    }
?>

