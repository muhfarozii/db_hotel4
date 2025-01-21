<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotel</title>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    
</head>
<style>
    body {
    margin: 0px;
    padding: 0px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    font-family: Arial, sans-serif;
    background-image: url('https://cdn.villa-bali.com/cache/fullSize/villas/villa-emile/villa-emile-33-pool-night-d-5b29c04adca54.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-position: center;
    color: white;
}

.hero {
    flex-grow: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 5em;
}

.hero h1 {
    font-size: 3em;
    margin: 0px;
    color:white;
}

.hero p {
    font-size: 1.5em;
    color:white;
}

.section {
    padding: 1em;
    background-color: rgba(255, 255, 255, 0.8);
    color: black;
    margin: 1em auto;
    border-radius: 8px;
    width: 80%;
    max-width: 1200px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.footer {
    background-color:;
    color: #fff;
    text-align: center;
    padding: 0em 0;
    margin-bottom:1em;
}
</style>
<body>
<?php include "navbar2.php";?> 

    <section class="hero" id="home">
        <div>
            <h1>Welcome to our Hotel</h1>
            <p>Experience the best stay with us</p>
        </div>
    </section>
  
    <footer class="footer" id="">
        <p>&copy; 2024 Luxury Hotel. Adem adem penake check in!.</p>
    </footer>
</body>
</html>
