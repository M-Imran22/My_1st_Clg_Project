<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="./style.css"> -->
  <link rel="stylesheet" href="./bootstrap-5.2.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->


  <title>Home</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "poppins", sans-serif;
    }


    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 120px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      z-index: 999;
      background-color: transparent;
    }


    .navbar.scrolled {
      background-color: rgb(3 144 151);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

    .nav-links li a:hover,
    .edit-btn:hover {
      background-color: white;
      color: black;

    }

    .nav-links li {
      margin: 0 10px;
    }

    .nav-links li a,
    .edit-btn {
      text-decoration: none;
      color: #fff;
      font-size: 20px;
      /* background-color: lightseagreen; */
      font-weight: bold;
      display: inline-block;
      padding: 4px 8px;
      border-radius: 3px;
      border: 2px solid white;
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
      background-color: #333;
      margin-bottom: 4px;
      border-radius: 2px;
    }

    .sidebar {
      position: fixed;
      top: 0;
      right: -300px;
      width: 300px;
      height: 100vh;
      background-color: #f8f8f8;
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
      text-decoration: none;
      color: #333;
      font-size: 16px;

    }

    .home {
      position: relative;
      width: 100%;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      flex-direction: column;
      /* background: #03464e; */
      padding: 100px 200px;

    }

    .home .content {
      z-index: 888;
      color: #fff;
      width: 70%;
      margin-top: 50px;

    }

    .home .content h1 {
      font-size: 4em;
      font-weight: 900;
      line-height: 75px;
      text-transform: uppercase;
      letter-spacing: 5px;
      margin-bottom: 40px;
    }

    .home .content h1 span {
      font-size: 1.2em;
      font-weight: 600;

    }

    .home .content p {
      margin-bottom: 65px;
    }

    .home .content a {
      color: #1680AC;
      padding: 15px 35px;
      background: #fff;
      font-size: 1.1em;
      font-weight: 500;
      text-decoration: none;
      border-radius: 2px;
    }

    .home img {
      z-index: 000;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(0.7);
    }

    .img-slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      transform: scale(0.5) translateX(-50%);
      transform-origin: center center;
      transition: opacity 1s ease-in-out, transform 0.8s cubic-bezier(0.6, 1, 0.6, 1);
      /* Updated transition timing function */
    }

    .img-slide.active {
      display: block;
      opacity: 1;
      transform: scale(1) translateX(0);
    }

    .content-slide {
      position: absolute;
      top: 50%;
      left: 50%;
      /* width: 100%;
    height: 100%; */
      opacity: 0;
      transform: scale(0.5) translateX(-50%);
      transform-origin: center center;
      transition: opacity 1s ease-in-out, transform 0.8s cubic-bezier(0.6, 1, 0.6, 1);
    }

    .content-slide.active {
      display: block;
      opacity: 1;
      transform: translate(-50%, -50%);
    }



    .slider-navigation {

      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
    }

    .slider-navigation .nav-btn {

      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: rgb(255, 255, 255);
      margin: 0 5px;
      cursor: pointer;
    }

    .slider-navigation .nav-btn:not(:last-child) {
      margin-right: 20px;
    }

    .slider-navigation .nav-btn:hover {
      transform: scale(1.2);
    }

    .slider-navigation .nav-btn.active {
      background: #03464e;
    }

    .cardSliderArea {

      position: relative;
      top: 250px;
      width: 100%;
      height: 900px;
      /* background-attachment: scroll; */
      background-image: url(/Pic/Cinque-Terre-Italy.jpg);
      background-blend-mode: darken;
      background-color: #cccccc;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      background-color: rgba(0, 0, 0, 0.4);
      background-attachment: fixed;
      position: relative;
      border: none;

    }

    .cardSliderArea .title {
      color: white;
      font-size: 40px;
      margin-top: 0px;
      text-align: center;
      font-weight: 800;
      padding: 100px 200px;

    }



    .cardSliderArea .contanir {
      position: absolute;
      height: 400px;
      top: 25%;
      left: -8%;
      right: 10%;
      border-radius: 15px;
      /* background-color: rgb(9, 175, 112, 0.7); */
      display: flex;
      /* transition: transform 1s ease-in-out; */
    }

    .contanir .carousel-indicators {
      bottom: -129px;
      left: 233px;
    }

    .contanir .carousel-control-next {
      right: -135px;
      top: 255px;
    }

    .contanir .carousel-control-prev {
      top: 240px;
      left: 155px;
    }

    .contanir .m-4 {
      margin: 20px -76px 20px 8px !important;
    }

    .contanir .row {
      padding: 140px;
      flex-wrap: nowrap !important;
    }

    .contanir img {
      /* position: relative; */
      width: 100%;
      height: 300px;
      border-radius: 8px;
    }

    .slide-show-caption {
      margin-top: -125px;
      margin-left: 20px;
      color: #fff;
    }

    .blogs-area {
      padding: 100px 200px;
    }

    .blogs-title {
      color: black;
      font-size: 40px;
      margin-top: 230px;
      text-align: center;
      font-weight: 800;
    }

    .blogs-lift {
      margin-left: -145px !important;
    }

    .blogs-liftContent {
      z-index: 888;
      width: 50%;
      margin-top: 130px;

    }

    .blogs-liftImg {
      margin-top: -280px;
      margin-right: -135px;
      width: 45% !important;
      height: 45% !important;
    }

    .blogs-right {
      margin-top: 130px;
      margin-right: -180px;

    }

    .blogs-rightContent {
      z-index: 888;
      width: 50%;
      margin-top: 100px;
      /* padding-left: 457px !important;
    margin-right: -520px !important; */
      float: right;
      /* text-align: right; */

    }

    .blogs-rightImg {
      /* margin-top: 280px; */
      /* margin-left: -600px !important; */
      margin-left: -140px;
      margin-top: 115px !important;
      width: 45% !important;
      height: 45% !important;
    }

    .footer {
      padding: 10px 0;
      background-color: rgb(0, 126, 126);
    }

    .footer .social {
      text-align: center;
      color: #80eeaa;
      margin-top: 20px;
    }

    .footer .social a {
      font-size: 24px;
      color: inherit;
      border: 1px solid #ccc;
      width: 40px;
      height: 40px;
      line-height: 38px;
      display: inline-block;
      text-align: center;
      border-radius: 50%;
      margin: 0 8px;
      opacity: 0.75;
    }

    .footer .social a:hover {
      opacity: 0.9px;
    }

    .footer ul {
      margin-top: 50px;
      padding: 0;
      list-style: none;
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 0;
      text-align: center;

    }

    .footer ul li a {
      color: inherit;
      text-decoration: none;
      opacity: 0.8;

    }

    .footer ul li {
      display: inline-block;
      padding: 0 15px;

    }

    .footer ul li a:hover {
      opacity: 1;
    }

    .footer .copyright {
      margin-top: 75px;
      text-align: center;
      font-size: 13px;
      color: #aaa;
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
      <a href="http://127.0.0.1/modified_project/Home.php"><img src="./Pic/logo.png" class="logoimg" alt="Logo"></a>
    </div>
    <ul class="nav-links">
      <li><a href="http://127.0.0.1/modified_project/About.php">About</a></li>
      <li><a href="http://127.0.0.1/modified_project/login.php">Login/Registor</a></li>

    </ul>
    <div class="toggle-button">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>

  <div class="sidebar">
    <ul class="sidebar-links">
      <li><a href="http://127.0.0.1/modified_project/About.php">About</a></li>
      <li><a href="http://127.0.0.1/modified_project/login.php">Login/Registor</a></li>

    </ul>
  </div>






  <section class="home">

    <img class="img-slide  active " src="./Pic/Galapagos-Islands.jpg" alt="Islands">
    <img class="img-slide" src="./Pic/Chittorgarh-Fort-India.jpg" alt="Fort-India">
    <img class="img-slide" src="./Pic/Cinque-Terre-Italy.jpg" alt="Terre-Italy">
    <img class="img-slide" src="./Pic/Giants-Causeway.jpg" alt="Giants-Causeway">
    <img class="img-slide" src="./Pic/Ha-Long-Bay-Vietnam.jpg" alt="Bay-Vietnam">
    <div class="content content-slide active ">
      <h1>Galapagos<br><span>Island</span></h1>
      <p>The Galapagos Islands are a remote archipelago located in the Pacific Ocean. They are known for their unique wildlife and pristine natural beauty. The islands offer opportunities for wildlife observation, snorkeling, and hiking, making it a popular destination for nature enthusiasts.</p>
      <a href="#">Read More</a>
    </div>
    <div class="content content-slide">
      <h1>Chittorgarh Fort<br><span>India</span></h1>
      <p> Chittorgarh Fort is one of the largest forts in India and a UNESCO World Heritage Site. It is located in the state of Rajasthan and holds great historical significance. The fort showcases impressive architecture and provides a glimpse into the rich cultural heritage of Rajasthan.</p>
      <a href="#">Read More</a>
    </div>
    <div class="content content-slide">
      <h1>Cinque Terre<br><span>Italy</span></h1>
      <p>Cinque Terre is a picturesque coastal region in Italy, comprising five colorful fishing villages: Monterosso al Mare, Vernazza, Corniglia, Manarola, and Riomaggiore. The area is renowned for its rugged cliffs, vineyards, and charming seaside atmosphere. Visitors can explore the villages by foot, enjoy the stunning coastal views, and savor local Italian cuisine.</p>
      <a href="#">Read More</a>
    </div>
    <div class="content content-slide">
      <h1>Giant's<br><span>Causeway</span></h1>
      <p> The Giant's Causeway is a natural wonder located in Northern Ireland. It is a geological formation consisting of thousands of interlocking basalt columns that were formed by volcanic activity millions of years ago. The unique hexagonal-shaped columns create a visually stunning landscape and attract visitors from around the world.</p>
      <a href="#">Read More</a>
    </div>
    <div class="content content-slide">
      <h1>Ha Long Bay<br><span>Vietnam</span></h1>
      <p>Ha Long Bay is a breathtaking natural wonder situated in northeastern Vietnam. It features emerald-green waters, towering limestone islands, and lush vegetation. The bay is a UNESCO World Heritage Site and offers opportunities for cruising, kayaking, and exploring magnificent caves, making it a must-visit destination in Vietnam.</p>
      <a href="#">Read More</a>
    </div>
    <div class="slider-navigation">
      <div class="nav-btn  "></div>
      <div class="nav-btn"></div>
      <div class="nav-btn"></div>
      <div class="nav-btn"></div>
      <div class="nav-btn"></div>
    </div>
  </section>

  <section class="cardSliderArea ">
    <h2 class="title">THE MOST VISTED PLACES IN THE WORLD</h2>

    <div class="contanir">

      <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">

        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselexamplecontrolsnotouching" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#carouselexamplecontrolsnotouching" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#carouselexamplecontrolsnotouching" data-bs-slide-to="2"></button>
        </div>
        <div class=" carousel-inner" style="width: 116%;">
          <div class="carousel-item active">
            <div class="row m-4 ">
              <div class="col-6 m-2">
                <div class="shadow-1-strong" style="background-color: rgba(0, 0, 0, 0.6);">
                  <img src="./Pic/Santorini-Greece.jpg" alt="Santorini-Greece">
                </div>
                <div class="slide-show-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content</br> for the second slide.</p>
                  <a href="">Read More</a>
                </div>
              </div>
              <div class="col-6 m-2">
                <img src="./Pic/Cinque-Terre-Italy.jpg" alt="Cinque-Terre-Italy">
                <div class="slide-show-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content</br> for the second slide.</p>
                  <a href="#">Read More</a>
                </div>
              </div>

            </div>
          </div>
          <div class="carousel-item ">
            <div class="row m-4 ">
              <div class="col-6 m-2">
                <div class="shadow-1-strong" style="background-color: rgba(0, 0, 0, 0.6);">
                  <img src="./Pic/Galapagos-Islands.jpg" alt="Galapagos-Islands">
                </div>
                <div class="slide-show-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content</br> for the second slide.</p>
                  <a href="#">Read More</a>
                </div>
              </div>
              <div class="col-6 m-2">
                <img src="./Pic/Giants-Causeway.jpg" alt="Giants-Causeway">
                <div class="slide-show-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content</br> for the second slide.</p>
                  <a href="#">Read More</a>
                </div>
              </div>

            </div>
          </div>
          <div class="carousel-item ">
            <div class="row m-4 ">
              <div class="col-6 m-2">
                <div class="shadow-1-strong" style="background-color: rgba(0, 0, 0, 0.6);">
                  <img src="./Pic/Ha-Long-Bay-Vietnam.jpg" alt="Ha-Long-Bay-Vietnam">
                </div>
                <div class="slide-show-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content</br> for the second slide.</p>
                  <a href="#">Read More</a>
                </div>
              </div>
              <div class="col-6 m-2">
                <img src="./Pic/pexels-david-bartus-586687.jpg" alt="pexels-david-bartus">
                <div class="slide-show-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content</br> for the second slide.</p>
                  <a href="#">Read More</a>
                </div>
              </div>

            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

  </section> <br> <br>


  <section class="blogs-area">
    <h2 class="blogs-title">TOP BLOGS</h2>

    <div class="blogs-lift" style="margin-left: -120px">
      <div class="blogs-liftContent">
        <h1>Jordan</h1>
        <h2>Completely safe oasis isolated from the instability of the region</h2>
        <p>Jordan is a place of supernatural beauty. Imagine Yosemite as a desert with super luxury tented camps. That’s a bit how Wadi Rum feels. And Petra is so ancient you could use the Bible as your guidebook rather than a Lonely Planet. Beyond these obvious destinations, there’s also Al Salt, Jarash, and Amman. Travel here with an open mind, and get ready for and a hospitality that will blow away any expectations. Photo by Scott Sporleder.</p>
        <a href="#">Read More</a>
      </div>

      <img src="./Pic/petra-jordan9.jpg" alt="petra-jordan " class="blogs-liftImg rounded float-end   ">
    </div>
    <div class="blogs-right ">
      <div class="blogs-rightContent">
        <h1>Dominical, Costa Rica</h1>
        <h2>Surf, yoga, and natural foods paradise within easy reach</h2>
        <p>ut of all the places in Costa Rica that should’ve gotten overrun with mass tourism, Dominical has been spared. It remains a small, uncrowded town with a super cool expat scene and awesome restaurants. There are exceptional AirBnb properties overlooking nearby Domincalito (as well as in town). For surfing, Dominical is almost never flat. Photo: Blaze Nowara.</p>
        <a href="#">Read More</a>
      </div>

      <div class="blogs-rightcontent-img"><img src="./Pic/Dominica-Blaze.jpg" alt="Dominica-Blaze" class="blogs-rightImg rounded"></div>
    </div>
    <div class="blogs-liftContent" style="margin-left: -120px">
      <h1>Havana, Cuba</h1>
      <h2>Rapidly transitioning nation grounded in Caribbean culture and vibrancy</h2>
      <p>Cuba has been among the hottest places to travel for our staff at Matador, with reports always containing two elements: 1. People have more fun there than anywhere else they’ve been in years, and 2. The wifi is the worst they’ve found anywhere (Correlation anyone?). On a recent filmmaking journey, it was noted: “Everyone here has rocking chairs. This is place where people know how to chill.”</p>
      <a href="#">Read More</a>
    </div>

    <img src="./Pic/Cuba-Scott-Sporleder.jpg" alt="Cuba-Scott-Sporleder " class="blogs-liftImg rounded float-end   ">
    </div>
    <div class="blogs-right ">
      <div class="blogs-rightContent">
        <h1>Abu Dhabi, UAE</h1>
        <h2>One of the best places in the world to experience Islamic culture</h2>
        <p>Abu Dhabi is a desert emirate, dotted with oasis towns, date farms, historic forts, natural reserves, mangroves, and dunes that have lured explorers throughout history. As one of the largest mosques on the planet, Sheikh Zayed Grand Mosque receives pilgrims from all over the world during Eid celebrations. Outside of prayer times, it’s also open to non-Muslims and has free guided tours.</p>
        <a href="#">Read More</a>
      </div>

      <img src="./Pic/palace-court-at-abu-dhabi-united-arab-emirates-uae.jpg" alt="palace-court-at-abu-dhabi-united-arab-emirates-uae " class="blogs-rightImg rounded    ">
    </div>

  </section>
  <script>
    const toggleButton = document.querySelector('.toggle-button');
    const sidebar = document.querySelector('.sidebar');

    toggleButton.addEventListener('click', () => {
      sidebar.style.right = sidebar.style.right === '0px' ? '-300px' : '0px';
    });


    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {

      if (window.scrollY > 0) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  </script>

  <?php
  require_once("footer.php");
  ?>