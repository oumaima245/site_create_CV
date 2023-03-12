 <?php

                        session_start();
                        if (!isset($_SESSION['user_id'])) {
                            header("Location: etatcivil.php");
                            exit;
                        }
                        // Connect to the database
                            $conn = mysqli_connect("localhost", "root", "", "php_projet");

                            // Check if connection was successful
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            // Retrieve education data for the user
                            $sql = "SELECT * FROM education WHERE user_id = " . $_SESSION['user_id'];
                            $result = mysqli_query($conn, $sql);

                            $education = array();
                            $year = array();
                            $degree = array();

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $education[] = $row['education'];
                                    $year[] = $row['year'];
                                    $degree[] = $row['degree'];
                                }
                            }

                            // Retrieve experience data for the user
                            $sql = "SELECT * FROM experiences WHERE user_id = " . $_SESSION['user_id'];
                            $result = mysqli_query($conn, $sql);

                            $company = array();
                            $position = array();
                            $duration = array();

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $company[] = $row['company'];
                                    $position[] = $row['position'];
                                    $duration[] = $row['duration'];
                                }
                            }
                            // Retrieve hobbies data for the user
                                $sql = "SELECT * FROM hobbies WHERE user_id = " . $_SESSION['user_id'];
                                $result = mysqli_query($conn, $sql);

                                $hobbies = array();

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $hobbies[] = $row['hobby'];
                                    }
                                }

                            // Retrieve user data
                            $sql = "SELECT * FROM users WHERE id = " . $_SESSION['user_id'];
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) == 1) {
                                $row = mysqli_fetch_assoc($result);
                                $nom = $row['nom'];
                                $prenom = $row['prenom'];
                                $email = $row['email'];
                                $adresse = $row['adresse'];
                                $tel = $row['telephone'];
                                $profil = $row['profil'];
                               

                                $_SESSION['username']=$nom;
                                $_SESSION['profil']=$profil;


                            }

                            // Close the database connection
                            mysqli_close($conn);
?>
                       
                        <style>
                                                                                .time {
                                                                                    width:40%;
                                                                                                    margin: 0 auto;
                                                                                                    padding: 20px;
                                                                                                    background-color: #cecfcf;
                                                                                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                                                                                                    font-family: Arial, sans-serif;
                                                                                                    font-weight: bold;
                                                                                                    

                                                                                }
                                                                                .left {
                                                                                    flex: 1;
                                                                                }
                                                                                .right {
                                                                                    flex: 0;
                                                                                    margin-left:70%;
                                                                                }
                                                                                

</style>
                        <html>

<head>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Share+Tech|Share+Tech+Mono" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <title>CV-template</title>
    <script>
        function draw() {
    var canvas = $('canvas')[0];
   
}

$(document).ready(function() {
    // $(document).draw();
    $('#content').animate({
        opacity:1,
        marginTop:'0',
    }, 800);
    $('h2').click(function() {
        $(this).next('.subtext').slideToggle('fast');
        $(this).children('.hex').toggleClass('moved');
    })
});
    </script>
</head>
<!-- HEADERSECTION FIX
 -->

 
 
 <div class="time" style=>
                            <span class="left"><?php $currentDate = date('Y-m-d'); echo $currentDate; ?></span>
                            <span class="right">  
                                <?php
                                if(!isset($_COOKIE['visits'])) {
                                    $visits = 1;
                                    setcookie('visits', $visits, time() + 3600 * 24 * 365); // set cookie for 1 year
                                } else {
                                    $visits = $_COOKIE['visits'] + 1;
                                    setcookie('visits', $visits, time() + 3600 * 24 * 365);
                                }
                                echo "<i class='fas fa-eye'></i> " . $visits;
                            ?></span>
                        </div>            

                        
<body onload="draw()">
    <canvas id="bg"></canvas>                

    <main id="content">
    
        <h1>
            <div class="hex moved"></div><span>About <?php echo $nom?> <?php echo $prenom;?></span></h1>
        <div class="subtext" id="main"> 
        <?php echo $profil;?><form action="logout.php" method="POST">
		<button type="submit" style="border-radius:50px">Déconnexion</button></form><form action="accuiel.php" method="POST">
		<button type="submit" style="border-radius:50px"><---</button>
	</form>
       
	</div>
        <h2>
            <div class="hex"></div><span>Educutions </span></h2>
        <div class="subtext coll">
            <div style="display: inline;"></div>
            <?php for($i=0; $i<count($education); $i++) { ?>
        <span style="font-size: 20px;"> * <?php echo $education[$i];?>-</span>
        <span style="font-size: 18px;"><?php echo $year[$i];?></span>
        <span style="font-size: 15px;"><?php echo $degree[$i] ;?></span> <br>
<?php } ?>
<h2>
        </div></div>
        <h2>
            <div class="hex"></div><span>Experiences</span></h2>
        <div class="subtext coll">
        <?php 
    for($i=0; $i<count($company); $i++) { 
?>
            <span style="font-size: 20px;"> * <?php echo $company[$i];?></span>
            <span style="font-size: 18px;"><?php echo $position[$i];?>-</span>
            <span style="font-size: 15px;"><?php echo $duration[$i];?></span>
        
<?php 
    } 
?>       </div> </div>
        <h2>
            <div class="hex"></div><span>  Hobies and Interests</span></h2>
        <div class="subtext coll">
        <?php 
    for($i=0; $i<count($hobbies); $i++) { 
?>
        <span style="font-size: 20px;"><?php echo $hobbies[$i];?></span> <br><?php 
    } 
?> 
      </div>
        
        <h2>
            <div class="hex"></div><span>Find Me</span></h2>
        <div class="subtext coll">
            <a>Twitter</a> | <a>Tumblr</a> | <a>Codepen</a> | <a>Behance</a>
        </div>
        
        <h2>
            <div class="hex"></div><span>Contact Me</span></h2>
        <div class="subtext coll">
            <ul>
                <li>Adress: <?php echo $adresse;?></li>
                <li>E-mail: <a ><?php echo $email;?></a></li>
                <li>Phone: <?php echo $tel;?></li>

            </ul>
        </div>
    </main>
    <svg viewBox="0 0 500 150" preserveAspectRatio="none" class="wave" id="one"><path d="M-13.36,88.98 C168.85,182.73 276.72,-73.84 506.31,79.10 L500.00,150.00 L0.00,150.00 Z"></path></svg>
    <svg viewBox="0 0 500 150" preserveAspectRatio="none" class="wave" id="two"><path d="M-13.36,88.98 C168.85,182.73 276.72,-73.84 506.31,79.10 L500.00,150.00 L0.00,150.00 Z"></path></svg>
    <div id="hex-holder">
        <div class="hex" id="uno"></div>
        <div class="hex" id="dos"></div>
        <div class="hex" id="tres"></div>
    </div>
</body>


</html>
                                <style>body {
                                    margin: 0;
                                    font-family: 'Share Tech', sans-serif;
                                    font-size:16px;
                                    color: #505050;
                                    background: #1B1B25;
                                    overflow-x:hidden;
                                }

                                main {
                                    position:relative;
                                    padding:7vh 0 10vh;
                                    opacity:0;
                                    margin-top:-5px;
                                }

                                @media all and (min-width:670px) {
                                    main { 
                                        width: 570px;
                                        margin-left: 10vw;
                                    }
                                }

                                @media all and (max-width:670px) {
                                    main { margin:0 15px }
                                }

                                .wave {
                                    width:100vw;
                                    height:150px;
                                    position:fixed;
                                    bottom:0;
                                    fill:#ababab;
                                    z-index:-1;
                                }

                                #one {
                                    height:180px;
                                    fill:#eeeeee;
                                    width:120vw;
                                    left:-10vw;
                                }

                                h1, h2 {
                                    position:relative;
                                    display:flex;
                                    align-items:center;
                                    font-family:'Share Tech Mono', monospace;
                                    line-height: 1em;
                                    word-spacing:-.1em;
                                    letter-spacing:-.05em;
                                    transition:.2s all ease;
                                    margin-left:10px;
                                    margin-bottom:15px;
                                }

                                h1 span, h2 span { 
                                    background:rgba(238,238,238,.7);
                                    padding:5px 7px;
                                    border-radius:10px;
                                    box-sizing:border-box;
                                }
                                h1, h2:active { color:#1B1B25; }
                                h1 { font-size:2.2em }
                                h2 { cursor:pointer }
                                p:first-child { margin-top:0 }
                                p:last-child { margin-bottom:0 }

                                .subtext {
                                    position:relative;
                                    border-radius:10px;
                                    background: white;
                                    border:1px solid;
                                    padding:13px;
                                    line-height:1.5em;
                                }

                                .subtext:not(#main) {
                                    display:none;
                                }

                                .subtext ul { margin:0; padding:0 25px; }

                                .subtext a { 
                                    color:#a9a9a9; 
                                    text-decoration:underline;
                                    cursor:pointer;
                                    transition:.2s all ease;
                                }

                                .subtext a:hover, h2:hover {
                                    color:#777;
                                }

                                .subtext:before {
                                    content:'';
                                    position:absolute;
                                    width:1px;
                                    background:#bbb;
                                    left:1.2em;
                                    height:1.2em;
                                    top:calc(-1.2em - 1px);
                                }

                                .subtext.coll:before {
                                    left:1em;
                                    height:1.2em;
                                    top:calc(-1.2em - 1px);
                                }

                                .hex:hover {
                                    transform:rotate(30deg);
                                }

                                .hex, .hex:before, .hex:after {
                                    height:1em;
                                    width:.59em;
                                    border:solid;
                                    border-width:1px 0;
                                    border-radius:2px;
                                    box-sizing:border-box;
                                }

                                main .hex { 
                                    position:relative;
                                    display:inline-block;
                                    margin-right:.5em;
                                    transition:.4s all ease;
                                }

                                .hex:before, .hex:after {
                                    content:'';
                                    position:absolute;
                                    margin-top:-1px;
                                    margin-left:;
                                /*     color:#ccc; */
                                }

                                .hex:before { transform:rotate(60deg); }
                                .hex:after { transform:rotate(-60deg); }

                                .hex, .hex:before, .hex:after, .subtext {
                                    border-color:#bbb;
                                }

                                .hex.moved {
                                    transform:rotate(30deg);
                                }

                                #hex-holder {
                                    position:fixed;
                                    height:100vh;
                                    width:100vw;
                                    top:0;
                                    z-index:-1;
                                    pointer-events:none;
                                    font-size:60px;
                                }

                                #hex-holder .hex {
                                    position:fixed;
                                }

                                #uno {
                                    border-radius:4px;
                                    /* border:none;
                                    background:#5b8b8c; */
                                    transform:rotate(-12deg);
                                    bottom:30vh;
                                    left:30px;
                                }

                                #uno:before, #uno:after {
                                    margin-top:0;
                                }

                                #hex-holder .hex:before, #hex-holder .hex:after {
                                    border:inherit;
                                    border-radius:inherit;
                                    background:inherit;
                                }

                                /* #dos {
                                    border-color:#1B7477;
                                    border-radius:3px;
                                    border-width:5px 0;
                                    font-size:100px;
                                    bottom:12vh;
                                    right:-20px;
                                    transform:rotate(7deg);
                                } */

                                #dos:before, #dos:after {
                                    margin-top:-5px;
                                }

                                #tres { display:none }

                                #bg {
                                /*     z-index:100; */
                                    position:fixed;
                                    top:0;
                                    height:100vh;
                                    width:100vw;
                                    box-sizing:border-box;
                                    border:5px solid black;
}</style>





