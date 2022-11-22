<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css"  type="text/css"/>
    <link rel="stylesheet" href="css/style.css"  type="text/css"/>
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
    <title>Viktoria Nikiforova | Designer | Illustrator | Frontend Developer</title>
</head>
<body>
   <header class="header" >
       <div class="container header-container" id="header">
           <a class="logo" href="index.html">
               <img src="img/logo.png" alt="Vika">
           </a>
           <nav class="menu list-reset">
               <ul class="menu-list">
                   <li class="menu-item"><a href="index.html" class="menu-link">Home</a></li>
                   <li class="menu-item"><a href="about.php" class="menu-link">About</a></li>
                   <li class="menu-item"><a href="portfolio.php" class="menu-link">Portfolio</a></li>
                   <li class="menu-item"><a href="services.php" class="menu-link">Services</a></li>
                   <li class="menu-item"><a href="contacts.php" class="menu-link">Contacts</a></li>
               </ul>
           </nav>
           <div class="menu-btn">
                <div class="menu-btn_burger"></div>
            </div>
       </div>
   </header>
   
   <main>
       <section class="hero">
            <div class="container">
                <div class="side-hero">
                    <div class="hero-content anim-items">
                        <span class="hero-subtitle" style="margin-bottom: 30px;">Hi, I'm</span>
                        <p style="margin-bottom: 50px;"> 
                            <span class="hero-title">Viktoria Nikiforova</span>
                        </p>
                            <ul class="hero-descr">
                                <li><span class="hero-subtitle">Frontend developer</span></li>
                                <li><span class="hero-subtitle">Graphic designer</span></li>
                                <li><span class="hero-subtitle">UI/UX designer</span></li>
                                <li><span class="hero-subtitle">Illustrator</span></li>
                            </ul>
                        <p>
                            <a href="contacts.php" class="contact">
                                <button id="contactBtn" class="contact btn-reset">CONTACT ME</button> 
                            </a>
                            
                        </p>
                    </div> 
                    <div class="hero-me">
                        <img class="home-image anim-items" src="img/hero-me.png" alt="me">
                    </div>
                </div>
            </div>
       </section>
       <section class="latest_works">
            <div class="container">
                <div style="margin-bottom: 50px;">
                    <h2 class="latest_works-title anim-items" >LATEST WORKS</h2>
                </div>
                <div class="latest_works-container anim-items">
                    <a href="portfolio.php#new">
                        <div class="latest_works-item"> 
                            <img class="latest_works-img" src="img/backgr1.png" alt="pic here">
                            <div style="padding-left: 10px;">
                                <h4 class="subtitle">
                                STROLLKY
                                </h4>
                                <p class="latest_works-descr">
                                    Product design, good fresh start 
                                </p>
                                <img class="arrow" src="img/arrowright.svg" alt="">

                            </div>
                            
                        </div>   
                    </a>  
                    <a href="portfolio.php#illustrations">
                    <div class="latest_works-item">
                            <img class="latest_works-img" src="img\backgr2.png" alt="pic here">
                            <div style="padding-left: 10px;">
                                <h4 class="subtitle">
                                    NEW AVATARS
                                </h4>
                                <p class="latest_works-descr">
                                    Not a commercial order actually
                                </p>
                                <img class="arrow" src="img/arrowright.svg" alt="">
                            </div>
                        
                        </div>
                    </a> 
                    <a href="portfolio.php#new">
                    <div class="latest_works-item">
                        <img class="latest_works-img" src="img\backgr3.png" alt="pic here">
                        <div  style="padding-left: 10px;">
                            <h4 class="subtitle">
                                VISUAL DESIGN
                            </h4>
                            <p class="latest_works-descr">
                                New steps
                            </p>
                            <div class="arrow">
                                <img src="img/arrowright.svg" alt="">
                            </div>
                            
                        </div>
                            
                       </div> 
                    </a> 
                    
                </div>   
            </div>
       </section>
   </main>
   <footer class="footer">
    <div class="container footer-container">
            <div class="footer-copyright">
                <small class="copyright">
                    <span>&#169; 2021 Viktoria Nikiforova</span> 
                </small>
            </div>
        </div>
    </footer>
    <script src="js/script.js"></script>
    <script type="text/javascript" src="js/preferences.js"></script>
</body>
</html>