document.addEventListener('DOMContentLoaded', function() {
  let video = document.querySelector('video');

  function updateProgressBar() {
    let progress = (video.currentTime / video.duration) * 100;
    progressBar.style.width = progress + '%';
  }

  video.addEventListener('timeupdate', updateProgressBar);

  video.addEventListener('click', function() {
    if (video.paused) {
      video.play();
    } else {
      video.pause();
    }
  });

  // Récupére le currentTime lors du chargement de la vidéo
  video.addEventListener('loadedmetadata', getCurrentTime);
});
