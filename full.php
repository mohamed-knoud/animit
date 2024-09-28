<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles3.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Animet - FULL SITE</title>
    <style>
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
    .logo {
  font-size: 30px;
  color: #F9E0BB;
}

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
   </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <a href="/" style="text-decoration:none;"><h1 class="logo">ANIMET</h1></a>
            </div>
        </div>
    </div>
    <div id="loader" class="loader"></div>
    <div class="container">
        <div class="content-container">
            <div id="start" class="featured-content">
                <!-- <img id="start" class="featured-title" src="img/f-t-1.png" alt=""> -->
                <p class="featured-desc"></p>
                <a id="link"><button style="cursor:pointer;" class="featured-button">WATCH</button></a>
            </div>
            <div id="pop" class="movie-list-container">
                <h1 class="movie-list-title">POPULAR</h1>
                <div class="movie-list-wrapper">
                <div class="movie-list">
                
                </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            <div id="tre" class="movie-list-container">
                <h1 class="movie-list-title">TRENDING</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">

                    </div>
                    <i class="fas fa-chevron-right arrow"></i>
                </div>
            </div>
            
        </div>
    </div>
    <script>
        const arrows = document.querySelectorAll(".arrow");



//TOGGLE

const movieLists = document.querySelectorAll(".movie-list");

let jaja = document.querySelectorAll('.movie-list')
let x = Math.round(Math.random() * 19);
let fafa = document.getElementById('start') 
let fgfg = document.querySelector('.featured-desc')
let link = document.getElementById("link")
fetch(`https://api.amvstr.me/api/v2/popular`)
      .then(response => response.json())
      .then(data => {
        // displaySuggestions(data);
        fafa.style.backgroundImage = `url(${data.results[x].bannerImage})`
        fgfg.textContent = data.results[x].description.slice(0,340) + "..."
        link.href = `watch.php?id=${data.results[x].id}`
        // <div class="movie-list">
        //                 <div class="movie-list-item">
        //                     <img class="movie-list-item-img" src="" alt="">
        //                     <span class="movie-list-item-title">Her</span>
        //                     <p class="movie-list-item-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. At
        //                         hic fugit similique accusantium.</p>
        //                     <button class="movie-list-item-button">Watch</button>
        //                 </div>
        //             </div>
        data.results.forEach(result=>{
           
            let div2 = document.createElement('div')
            div2.classList.add('movie-list-item')
            
            let img = document.createElement('img')
            img.classList.add('movie-list-item-img')
            if(result.bannerImage)
                img.src = result.bannerImage
            else
                img.src = "not.png"
            let span = document.createElement('span')
            span.classList.add('movie-list-item-title')
            span.textContent = result.title.english
            let p = document.createElement('p')
            p.classList.add('movie-list-item-desc')
            p.textContent = result.description.slice(0,100)+"..."
            let button = document.createElement('button')
            button.classList.add('movie-list-item-button')
            button.textContent = 'Watch'
            let a = document.createElement('a')
            a.href= `watch.php?id=${result.id}`
            a.appendChild(button)
            div2.appendChild(img)
            div2.appendChild(span)
            div2.appendChild(p)
            div2.appendChild(a)
            // jaja.appendChild(div1)
            jaja[0].insertBefore(div2, jaja.firstChild);

        })
                document.getElementById("loader").style.display = "none";

        arrows.forEach((arrow, i) => {
  const itemNumber = movieLists[i].querySelectorAll("img").length;
  let clickCounter = 0;
  arrow.addEventListener("click", () => {
    const ratio = Math.floor(window.innerWidth / 270);
    clickCounter++;
    if (itemNumber - (5 + clickCounter) + (5 - ratio) >= 0) {
      movieLists[i].style.transform = `translateX(${
        movieLists[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
    } else {
      movieLists[i].style.transform = "translateX(0)";
      clickCounter = 0;
    }
  });
});

        
        
      })
      .catch(error => {
        console.error('Error fetching suggestions:', error);
      });
      fetch(`https://api.amvstr.me/api/v2/trending`)
      .then(response => response.json())
      .then(data => {
        // displaySuggestions(data);
        
        data.results.forEach(result=>{
           
            let div2 = document.createElement('div')
            div2.classList.add('movie-list-item')
            
            let img = document.createElement('img')
            img.classList.add('movie-list-item-img')
            if(result.bannerImage)
                img.src = result.bannerImage
            else
                img.src = "not.png"
            let span = document.createElement('span')
            span.classList.add('movie-list-item-title')
            span.textContent = result.title.english
            let p = document.createElement('p')
            p.classList.add('movie-list-item-desc')
            p.textContent = result.description.slice(0,100)+"..."
            let button = document.createElement('button')
            button.classList.add('movie-list-item-button')
            button.textContent = 'Watch'
            let a = document.createElement('a')
            a.href= `watch.php?id=${result.id}`
            a.appendChild(button)
            div2.appendChild(img)
            div2.appendChild(span)
            div2.appendChild(p)
            div2.appendChild(a)
            // jaja.appendChild(div1)
            jaja[1].insertBefore(div2, jaja.firstChild);

        })
       
        arrows.forEach((arrow, i) => {
  const itemNumber = movieLists[i].querySelectorAll("img").length;
  let clickCounter = 0;
  arrow.addEventListener("click", () => {
    const ratio = Math.floor(window.innerWidth / 270);
    clickCounter++;
    if (itemNumber - (5 + clickCounter) + (5 - ratio) >= 0) {
      movieLists[i].style.transform = `translateX(${
        movieLists[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
    } else {
      movieLists[i].style.transform = "translateX(0)";
      clickCounter = 0;
    }
  });

  console.log(Math.floor(window.innerWidth / 270));
});
        
        
      })
      .catch(error => {
        console.error('Error fetching suggestions:', error);
      });

      
    </script>
</body>

</html>