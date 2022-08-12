var arr = ['“Don’t Let Yesterday Take Up Too Much Of Today.”',
'“It’s Not Whether You Get Knocked Down, It’s Whether You Get Up.”',
'“If You Are Working On Something That You Really Care About, You Don’t Have To Be Pushed. The Vision Pulls You.”',
'“People Who Are Crazy Enough To Think They Can Change The World, Are The Ones Who Do.”',
'“Failure Will Never Overtake Me If My Determination To Succeed Is Strong Enough.”'];
var i = 0;
setInterval(function(){
  document.getElementById('quote').innerHTML = arr[i];
  if ((++i) == 5) {
    i = 0;
  }
}, 7500);
