var posts = Array.from(document.getElementsByClassName('post'));
posts.forEach((item, i) => {
  item.addEventListener("mouseover",function(el){
    item.classList.remove("scale-down");
    item.classList +=  " scale-up";
  })
  item.addEventListener("mouseout",function(el){
    posts.forEach((item, i) => {
      item.classList.remove("scale-up");
      item.classList +=  " scale-down";
    });
  })
});
