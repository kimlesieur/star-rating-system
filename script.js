var stars = {
  // Attach hover and click events with their respective functions
  init : () => {
    for (let d of document.getElementsByClassName("pStar")) 
    { 
      let selectAllStars = d.getElementsByClassName("star");
          for (let star of selectAllStars) {
            star.onmouseover = () => { stars.hover(selectAllStars, star.dataset.num); };
            star.onclick = () => { stars.click(d.dataset.pid, star.dataset.num); };
          }
    }
  },

  hover : (stars, datanum) => {
    let now = 1;
    for (let star of stars) {
        if (now <= datanum) { 
          star.classList.remove("blank"); 
        } else { 
          star.classList.add("blank"); 
        }
        console.log("now :", now);
        console.log("datanum :", datanum);
        now++;
    }
  },

  // On click submit the hidden form from index.php
    click : (pid, rating) => {
    document.getElementById("product").value = pid;
    document.getElementById("starNum").value = rating;
    document.getElementById("form").submit();
  }
};

window.addEventListener("DOMContentLoaded", stars.init);
