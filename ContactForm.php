<html>
    <head>
        
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    
    <style>
        .form-group {
            min-height:50px;
        }
    </style>
    
    </head>
    <body style="background-color:#f58345;">
         <div class="row" style="margin-top:2em;" >
                <div class="col-sm-1">
                </div>
                
                <div class="col-sm-10">
                                
                    <div class="card" style="padding:1em; border-radius:10px; ">
                        <div class="card-header" style="padding:0px; ">
                                <div class="row"  >
                                <div class="col-sm-5"  style="padding:0px;">
                                    LOGO
                                </div>
                                
                                <div class="col-sm-6" style="background-color:white;">   
                                    <h3 style="bottom:0px;">Sign-Up To Recieve Updates!</h3>
                                    <p> Be the first to know when the service goes live.</p>
                                </div>
                                
                                
                        </div>
                            
                        </div>
                        <div class="card-body">
                            <form  method="POST" id="signUpForm">
                                <div class="form-group">
                                   <h5>Contact Info: </h5> 

                                    <label for="first_name" class="fa fa-user"> Full Name: </label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" required>

                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group">
                                        <label for="emailLabel" class="fa fa-envelope"> Email: </label>
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                </div>
                                
                                <div class="form-group"> <!--add validation -->
                                    <label for="phone" class="fa fa-phone" > Phone Number: </label>
                                    <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" >
                                </div>
                                 
                                <div class="form-group"> <!--add validation -->
                                    <label for="country" class="fa fa-file" > Message: </label>
                                    <textarea  class="form-control" name="message_content" id="message_content" required> Let Us Know How We Can Help You!
                                    </textarea>
                                </div>
                                
                                </div>
                                
                                
                        
                                
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4">
           
                                            
                                             <button type="reset" class="btn btn-danger"  value="Clear" style="width:100%;" >Clear</button> 
                                        </div>
                                        <div class="col-sm-4">
                                            
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="Submit" class="btn btn-success" id="Submit" value="Submit" name="Submit" style="width:100%;" required>Submit</button>
                                        </div>
                                    </div>
                                </div>

    
                            </form>
                            
                            
                            
                        </div>
                    </div>
                    

                </div>
                <div class="col-sm-1">
                    
                </div>
                
                
            </div>
        
        
            <?php 
            require 'vendor/autoload.php'; // Required for Composer to run

           //var_dump($GLOBALS); //used to test incomming variables by displaying to screen

           if(isset($_POST['Submit'])){ // confirm form has been completed
                $first_name = $_POST['first_name'];//Assign variables from form
                $last_name = $_POST['last_name'];
                $email_address =  $_POST['email'];
                $phone_number =  $_POST['phone_number'];
                $full_name = $first_name . "," . $last_name; // append both names
                $message_content = $_POST['message_content'];

                /* Email Send Begins */


                        $email = new \SendGrid\Mail\Mail(); 
                        $email->setFrom($email_address, $full_name ); //sets whos it from
                        $email->setSubject("Contact Form Submission");//Subject name
                        $email->addTo("YourSupportEmail@example.com"); //who the email is sent to
                        //start of message - format using html and php for vars
                        $email->addContent(
                            "text/html",   "<h1>Contact Form - Submission </h1>
                                            <h2>From: </h2>
                                            <b>First Name:</b> $first_name <br/>
                                            <b>Last Name:</b> $last_name<br/>
                                            <b>Email:</b> $email_address<br/>
                                            <b>Phone:</b> $phone_number<br/>
                                            
                                            <h2>Message:</h2>
                                            <p> $message_content </p>
                                            "
                        );//end of message
                        $sendgrid = new \SendGrid("SG.b3s************************************************"); //API CODE goes here
                        try {
                            $response = $sendgrid->send($email); // send email
                            //error handling dont want it to show to user
                            //print $response->statusCode() . "\n";
                            //print_r($response->headers());
                           //print $response->body() . "\n";
                        } catch (Exception $e) {
                           // echo 'Caught exception: '. $e->getMessage() ."\n";
                        }

                /* Email Send Ends */

           }      
        ?>
           
    </body>    
</html>