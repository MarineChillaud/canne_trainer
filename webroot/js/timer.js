document.addEventListener("DOMContentLoaded", function() {
  var video = document.querySelector("iframe");
  var timer = document.getElementById("timer");
  var interval; // Variable pour stocker l'ID de l'intervalle

  // Écoute l'event "play" de la vidéo pour démarrer le minuteur
  video.addEventListener("play", function() {
    startTimer();
  });

  // Démarre le minuteur
  function startTimer() {
    var seconds = 0;
    timer.innerHTML = formatTime(seconds); // Afficher le temps initial
    interval = setInterval(function() {
      seconds++;
      timer.innerHTML = formatTime(seconds);
    }, 1000);
  }

  // Formate le temps au format MM:SS
  function formatTime(seconds) {
    var minutes = Math.floor(seconds / 60);
    var remainingSeconds = seconds % 60;
    return ("0" + minutes).slice(-2) + ":" + ("0" + remainingSeconds).slice(-2);
  }
});
