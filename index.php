<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animet - Home</title>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

       

        @media screen and (max-width: 700px) {
            #anime{
              display:none;
            }
            #search{
              width:80%;
            }
            #links{
              flex-direction:column;
            }
            #links li{
              margin-left:50px;
              margin-bottom:20px;
            }
            h1,#search,#view,#desc{
              margin-top:50px;
              margin-left:40px;
            }
            #suggestion-list{
              margin-left:40px;
            }
        }

        .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
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
<body>
    <header>
        <ul id="links">
            <a href="/"><li>HOME</li></a>
            <a href="full.php#pop"><li>POPULAR</li></a>
            <a href="full.php#tre"><li>TRENDING</li></a>
            <?php 
                if(isset($_COOKIE['last_watched_episode']) AND isset($_COOKIE['anime_id'])) {
                    $last_watched_episode = $_COOKIE['last_watched_episode'];
                    $anime_id = $_COOKIE['anime_id'];
                    echo "<a href='watch.php?id=$anime_id&Id=$last_watched_episode'><li>LAST WATCHED EPISODE</li></a>";
                }
            ?>
            
        </ul>
        
    </header>
    <h1>ANIMET</h1>
    <input placeholder='SEARCH FOR ANIME...' type="text" id="search" oninput="getSuggestions(this.value)"/>
    <div id="suggestion-list"></div>
    <img id="anime" src="anime.png"/>
    <a href="full.php"><div id="view">VIEW FULL SITE <i class="fa-solid fa-arrow-right"></i></div></a>
    <p id="desc">
    Animet – Watch Anime Online for FREE
<br/><br/>
1/ What’s Animet?
Animet is a free anime streaming site where you can watch anime online in HD quality for free with English subtitles.
<br/><br/>
2/ Is Animet safe?
Yes. We do not run advertisements.
<br/><br/>
3/ What make Animet the best site to watch anime free online?
<br/><br/>
– Updates: Our content is updated hourly, most of the works done automatically so you will get update as fast as possible.
<br/><br/>
– User interface: We focus on the simple and easy to use, so you will feel the life is easier here. We also have almost every feature that other anime streaming sites have, but not the opposite.
<br/><br/>
– Device compatibility: Animet works fine on both desktop and mobile devices, even with old browsers, so you can enjoy your anime anywhere you want.
<br/><br/>
So, if you want a good and safe place to watch anime online for free, give Animet a try, and if you like what we provided, please help us by sharing Animet to your friends and do not forget to bookmark our site.
<br/><br/>
Thanks!
    </p>
    <script>
  const inputField = document.getElementById('search');
  const suggestionList = document.getElementById('suggestion-list');

  function getSuggestions(input) {
    // Fetch suggestions from the server based on user input
    fetch(`https://api.amvstr.me/api/v2/search?q=${input}`)
      .then(response => response.json())
      .then(data => {
        displaySuggestions(data);
      })
      .catch(error => {
        console.error('Error fetching suggestions:', error);
      });
  }

  function displaySuggestions(suggestions) {
    // Clear previous suggestions
    suggestionList.innerHTML = '';

    // Display the suggestion list
    if (suggestions.results.length > 0) {
      suggestions.results.forEach(suggestion => {
        const suggestionItem = document.createElement('div');
        const suggestionA = document.createElement('a')
        const suggestionImg = document.createElement('img')
        const suggestionP = document.createElement('p')
        suggestionItem.classList.add('suggestion-item');
        suggestionImg.classList.add('suggestion-img');
        suggestionImg.src = suggestion.coverImage.large
        suggestionP.textContent = suggestion.title.userPreferred.slice(0,40);
        suggestionItem.appendChild(suggestionImg)
        suggestionItem.appendChild(suggestionP)
        suggestionA.appendChild(suggestionItem)
        suggestionA.href = `watch.php?id=${suggestion.id}`
        suggestionList.appendChild(suggestionA);
      });

      suggestionList.style.display = 'block';
    } else {
      suggestionList.style.display = 'none';
    }
  }

  // Close the suggestion list when clicking outside the input field
  document.addEventListener('click', (event) => {
    if (!inputField.contains(event.target) && !suggestionList.contains(event.target)) {
      suggestionList.style.display = 'none';
    }
  });
</script>
</body>
</html>