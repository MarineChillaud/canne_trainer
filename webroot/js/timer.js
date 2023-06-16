document.addEventListener('DOMContentLoaded', function() {
  let video = document.querySelector('video');
  let currentTimeInput = document.getElementById('current_time');
  let redButton = document.querySelector('.btn-danger');
  let blueButton = document.querySelector('.btn-primary');

  function updateProgressBar() {
    let progress = (video.currentTime / video.duration) * 100;
    progressBar.style.width = progress + '%';
  }

  function getCurrentTime() {
    console.log(video.currentTime);
    currentTimeInput.value = video.currentTime;
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

  redButton.addEventListener('click', function() {
    getCurrentTime();
    console.log('Timing redButton : ', video.currentTime);
  });
  blueButton.addEventListener('click', function() {
    getCurrentTime();
    console.log('Timing blueButton : ', video.currentTime);
  });

  // Récupére le currentTime lors du chargement de la vidéo
  video.addEventListener('loadedmetadata', getCurrentTime);
});

