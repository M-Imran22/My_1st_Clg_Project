 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./bootstrap-5.2.3-dist/css/bootstrap.min.css">
     <link rel="stylesheet" href="./font-awesome.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <title>About Us</title>
     <style>
         body {
             background-image: url(./Pic/pexels-pok-rie-982263.jpg);
             background-position: center;
             background-repeat: no-repeat;
             background-size: cover;
         }

         .about {
             width: 60%;
             margin: 10% 20%;
             border: 1px solid black;
             text-align: center;
             padding: 5%;
             /* display: flex; */
             justify-content: center;
             align-items: center;
             min-height: 10vh;
             background: linear-gradient(rgba(0, 0, 0, 0)0%, rgba(0, 0, 0, 0.5)100%) url(./Pic/peakpx.jpg) no-repeat;
             background-size: cover;
             background-position: center;
             border-radius: 20px;
             backdrop-filter: blur(15px);
             box-shadow: 0 0 30px rgba(10, 99, 158, 0.5);

         }

         .aboutimg {
             display: inline-block;
         }

         .aboutimg img {
             border-radius: 50%;
             width: 60px;
             height: 60px;
         }

         .about p {
             font-size: 20px;
         }

         .social {
             font-size: 30px;

         }

         .social a i:hover {
             color: red;
         }


         .navbar {
             position: absolute;
             top: 0;
             left: 0;
             width: 100%;
             display: flex;
             justify-content: space-between;
             align-items: center;
             padding: 10px 20px;
             z-index: 999;
             background-color: transparent;
         }

         .logoimg {
             width: 144px;
             padding-left: 20px;
         }

         .logo a {
             display: inline-block;
             margin-left: 25px;
         }

         .nav-links {
             list-style: none;
             display: flex;
             justify-content: flex-end;
             align-items: center;
             margin: 0;
             padding: 0;
             padding-right: 50px;

         }

         .nav-links li a:hover {
             background-color: black;
             color: white;

         }

         .nav-links li {
             margin: 0 10px;
         }

         .nav-links li a {
             text-decoration: none;
             color: black;
             font-size: 20px;
             /* background-color: lightseagreen; */
             font-weight: bold;
             display: inline-block;
             padding: 4px 8px;
             border-radius: 3px;
             border: 2px solid black;
             padding-left: -40px;
         }

         .toggle-button {
             display: none;
             flex-direction: column;
             cursor: pointer;
         }

         .toggle-button span {
             height: 2px;
             width: 25px;
             background-color: #fff;
             margin-bottom: 4px;
             border-radius: 2px;
         }

         .sidebar {
             position: fixed;
             top: 0;
             right: -300px;
             width: 230px;
             height: 100vh;
             background-color: #74f1ae;
             transition: right 0.3s ease-in-out;
             z-index: 998;
         }

         .sidebar-links {
             list-style: none;
             margin: 0;
             padding: 20px;
         }

         .sidebar-links li {
             margin-bottom: 10px;
         }

         .sidebar-links li a {
             font-weight: bold;
             text-decoration: none;
             color: #333;
             font-size: 16px;

         }

         @media (max-width: 768px) {
             .toggle-button {
                 display: flex;
             }

             .sidebar {
                 right: 0;
             }

             .sidebar-links {
                 padding: 40px 20px;
             }

             .navbar {
                 justify-content: space-between;
             }

             .nav-links {
                 display: none;
             }

             .nav-links.active {
                 display: flex;
                 flex-direction: column;
                 align-items: center;
                 justify-content: center;
                 position: absolute;
                 top: 60px;

             }
         }
     </style>
 </head>

 <body>


     <nav class="navbar">
         <div class="logo">
             <a href="http://127.0.0.1/modified_project/post_1.php"><img src="./Pic/TTT-logos_black.png" class="logoimg" alt="Logo"></a>
         </div>
         <ul class="nav-links">
             <li><a href="http://127.0.0.1/modified_project/post_1.php">Home</a></li>

         </ul>
         <div class="toggle-button">
             <span></span>
             <span></span>
             <span></span>
         </div>
     </nav>

     <div class="sidebar">
         <ul class="sidebar-links">
             <li><a href="http://127.0.0.1/modified_project/post_1.php">Home</a></li>
         </ul>
     </div>



     <section class="about">
         <div class="aboutimg">
             <img src="./IMG-20220921-WA0017.jpg" alt="">
             <img src="./Imran.jpeg" alt="">
         </div>
         <h1>About Us</h1>

         <p>
             We are students of Governament Degree Collge Lahor Swabi from Department of Computer Science doing specialization in Webdevelopment currently studying in 4th semester.
         </p>
         <div class="social">
             <a href="#"><i class="fab fa-instagram"></i></a>
             <a href="#"><i class="fab fa-facebook"></i></a>
             <a href="#"><i class="fab fa-twitter"></i></a>
         </div>
     </section>
 </body>

 </html>