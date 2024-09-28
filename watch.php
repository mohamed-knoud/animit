<?php 
$cookie_name = "anime_id";
$cookie_value = $_GET['id'];
setcookie($cookie_name, $cookie_value, time() + 3600*24*365, "/");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Animet - Watching</title>
    <script src="//cdn.jsdelivr.net/npm/hls.js@1"></script>
    <style>
        /* width */
        ::-webkit-scrollbar {
        width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey; 
        border-radius: 10px;
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: rgb(118, 88, 39); 
        border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: rgb(101, 69, 31); 
        }
        .loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #F1E0B1;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    position: fixed;
    top: 50%;
    left: 50%;
    margin-top: -25px;
    margin-left: -25px;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    </style>
</head>
<body style="background-color: #151515;">
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <a style="text-decoration:none;" href="index.php"><h1 class="logo" style="text-transform:uppercase;">Animet</h1></a>
            </div>
        </div>
    </div>
    
    <div id="loader" class="loader"></div>

    
    <div id="cont">
        <div id="lis">
            <ul id="epstitle">
                
            </ul>
        </div>
        <div id="tt">
           <iframe src="" frameborder="0" allowfullscreen scrolling="no" id="iframe"  width="100%"></iframe>
            <h1 style="color:white;" id="anime"></h1>
        </div>
    </div>
    <script>
        // Make a GET request using the fetch API
        
        let flag = 1
        let flag2 = 1
        let id = document.getElementById('anime')
        let src = document.getElementById('iframe')
        let i = document.getElementById('epstitle')
        if(<?php if(isset($_GET['Id'])) echo 1; else echo 0;?>){
            flag2 = 0
            fetch(`https://api.amvstr.me/api/v2/stream/<?php echo $_GET['Id'];?>`)
                                .then(function(response) {
                                    // Check if the response status is OK (200)
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    // Parse the response as JSON
                                    return response.json();
                                })
                                .then(function(data) {
                                    // Handle the JSON data here
                                    // <source src="movie.mp4" type="video/mp4">
                                    src.src = data.plyr.main
                                    anime.textContent = data.info.title
                                    
                            document.getElementById("loader").style.display = "none";
                                    console.log(data);
                                    
                                })
                                .catch(function(error) {
                                    // Handle any errors that occurred during the fetch
                                    console.error('Fetch error:', error);
                                });
            flag = 0;
        }
            fetch(`https://api.amvstr.me/api/v2/episode/<?php echo $_GET['id'];?>`)
                .then(function(response) {
                    // Check if the response status is OK (200)
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Parse the response as JSON
                    return response.json();
                })
                .then(function(data) {
                    // Handle the JSON data here
                    console.log(data);
                    if(flag2==1){let cookie_value = data.episodes[0].id;
                    // Set the cookie to expire in 1 hour (3600 seconds)
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', `ajax_handler.php?q=${cookie_value}`, true);
                    xhr.send();}
                    data.episodes.forEach(episode=>{
                            if(flag==1){
                            fetch(`https://api.amvstr.me/api/v2/stream/${episode.id}`)
                                .then(function(response) {
                                    // Check if the response status is OK (200)
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    // Parse the response as JSON
                                    return response.json();
                                })
                                .then(function(data) {
                                    // Handle the JSON data here
                                    // <source src="movie.mp4" type="video/mp4">
                                    
                                    src.src = data.plyr.main
                                    console.log(data);
                                    anime.textContent = data.info.title
                                    document.getElementById("loader").style.display = "none"; 
                                })
                                .catch(function(error) {
                                    // Handle any errors that occurred during the fetch
                                    console.error('Fetch error:', error);
                                });
                            flag = 0
                        }
                        let li = document.createElement('li')
                        let a = document.createElement('a')
                        let srcc = episode.image?episode.image:'not.png';
                        li.innerHTML = `<span>${episode.title}</span><img class='gur' src='${srcc}'/>`
                        li.onclick = function(){
                            
                            let cookie_value = episode.id;
                            
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', `ajax_handler.php?d=${cookie_value}`, true);
                            xhr.send();
                            document.getElementById("loader").style.display = "block"; 
                            // Make a GET request using the fetch API
                            fetch(`https://api.amvstr.me/api/v2/stream/${episode.id}`)
                                .then(function(response) {
                                    // Check if the response status is OK (200)
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    // Parse the response as JSON
                                    return response.json();
                                })
                                .then(function(data) {
                                    // Handle the JSON data here
                                    // <source src="movie.mp4" type="video/mp4">
                                    src.src = data.plyr.main
                                    
                            document.getElementById("loader").style.display = "none";
                                    console.log(data);
                                    
                                })
                                .catch(function(error) {
                                    // Handle any errors that occurred during the fetch
                                    console.error('Fetch error:', error);
                                });
                            
                        }
                        i.appendChild(li)
                    })
                    
                })
                .catch(function(error) {
                    // Handle any errors that occurred during the fetch
                    console.error('Fetch error:', error);
                });
    </script>
    
</body>
</html>