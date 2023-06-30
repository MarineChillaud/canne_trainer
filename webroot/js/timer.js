document.addEventListener('DOMContentLoaded', function() {
  let video = document.querySelector('video');
  let redButton = document.querySelector('.btn-danger');
  let blueButton = document.querySelector('.btn-primary');
  let redCurrentTimeInput = document.getElementById('current_time_red');
  let blueCurrentTimeInput = document.getElementById('current_time_blue');

  function updateProgressBar() {
    let progress = (video.currentTime / video.duration) * 100;
    progressBar.style.width = progress + '%';
  }

  function getCurrentTime() {
    console.log(video.currentTime);
    redCurrentTimeInput.value = video.currentTime;
    blueCurrentTimeInput.value = video.currentTime;
  }

  video.addEventListener('play', getCurrentTime);
  video.addEventListener('pause', getCurrentTime);
  video.addEventListener('timeupdate', updateProgressBar);

  video.addEventListener('click', function() {
    if (video.paused) {
      video.play();
    } else {
      video.pause();
    }
  });

  let xhr = new XMLHttpRequest();

  function alertContent (){
    if(xhr.readyState === 4 && xhr.status === 200) {
      console.log(xhr.responseText);
    } else {
      console.log('Il y a eu un soucis avec la requête');
    }
  }
    function sendAjaxRequest(currentTime, color) {
    xhr.onreadystatechange = alertContent;
    xhr.open('POST', 'videos/view/', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('color=' + encodeURIComponent(color) + '&currentTime=' + encodeURIComponent(currentTime));
  }

  redButton.addEventListener('click', function() {
    getCurrentTime();
    console.log('Timing redButton : ', video.currentTime);
    const redCurrentTime = video.currentTime;
    const color = 'red'
    sendAjaxRequest(redCurrentTime, color);
  });
  blueButton.addEventListener('click', function() {
    getCurrentTime();
    console.log('Timing blueButton : ', video.currentTime);
    const blueCurrentTime = video.currentTime;
    const color = 'red'
    sendAjaxRequest(blueCurrentTime, color);
    });

  // Récupére le currentTime lors du chargement de la vidéo
  video.addEventListener('loadedmetadata', getCurrentTime);
});

