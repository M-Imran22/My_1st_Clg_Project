<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-image: url(./asserts/images/jagoda-kondratiuk-sDeGlMAwcH4-unsplash.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            
        }
    </style>
    <title>Document</title>
</head>
<body>
    
    <div class="first_section">
        <div class="contact_us"><br><br><br>
            <h1>Contact us</h1> <br><br><br>
            <p>Need to get in touch with us? Either fill out the <br> form with your inquiry or find the <a href="#">department<br>email</a> you'd like to contact below.</p>
        </div>
        <div class="contact_form">
                <div class="flname">
                     <div class="firstname">
                     <label for="firstname" class="firstname">First name*</label><br>
                     <input type="text" name="firstname" id="firstname">  
                     </div>     
                    <div class="lastname"> 
                     <label for="lastname">Last name</label><br>
                     <input type="text" name="lastname" id="lastname"><br>
                    </div>
                </div> <br>
                     <label for="email">Email*</label><br>
                     <input type="email" name="email" id="email"><br><br>
                     <p>What can we help you with?</p>
                     <textarea name="" id="textarea" cols="30" rows="5"></textarea><br>
                     <input type="submit" id="submit_button" value="Submit">
        </div>
    </div>

</body>
</html>