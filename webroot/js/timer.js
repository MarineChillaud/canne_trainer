document.addEventListener('DOMContentLoaded', function() {
  let video = document.querySelector('video');
  let redButton = document.getElementById('redButton');
  let blueButton = document.getElementById('blueButton');
  let redCurrentTimeInput = document.getElementById('current_time_red');
  let blueCurrentTimeInput = document.getElementById('current_time_blue');
  let redTimeFlag = null;
  let blueTimeFlag = null;

  function updateProgressBar() {
    let progress = (video.currentTime / video.duration) * 100;
    progressBar.style.width = progress + '%';
  }

  function getCurrentTime() {
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

  function updateTimeFlags() {
    if (redTimeFlag !== null) {
      const redFlag = document.createElement('div');
      redFlag.className = 'vr bg-danger';
      redFlag.style.left = `${redTimeFlag}%`;
      redFlag.style.height = '100%';
      progressBar.appendChild(redFlag);
    }

    if (blueTimeFlag !== null) {
      const blueFlag = document.createElement('div');
      blueFlag.className = 'vr bg-primary';
      blueFlag.style.left = `${blueTimeFlag}%`;
      blueFlag.style.height = '100%';
      progressBar.appendChild(blueFlag);
    }
  }

  let xhr = new XMLHttpRequest();

  function alertContent (){
    if(xhr.readyState === 4){
      if (xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        // Mettre à jour les boutons rouges et bleus avec les nouveaux points
        redButton.textContent = response.points.red;
        blueButton.textContent = response.points.blue;

        //Mettre à jours les indicateurs de temps/point
        redTimeFlag = response.points.red;
        blueTimeFlag = response.points.blue;

        // Mettre à jours les flags sur la progressBar 
        updateTimeFlags();

      } else {
      console.error('Il y a eu un soucis avec la requête');
      }
    }
  }

  function sendAjaxRequest(event) {
    event.preventDefault();
    getCurrentTime(); //??
    let sourceForm=event.target.parentNode;
    sourceForm.querySelector("input[name='current_time']").value=video.currentTime;
    let sourceFormAction=sourceForm.getAttribute('action');
    let sourceFormData= new FormData(sourceForm);
 

   let jsonData = {};
   sourceFormData.forEach((value, key) => {
    jsonData[key] = value;
   });

    xhr.onreadystatechange = alertContent;
    xhr.open('POST', sourceFormAction, true);
    xhr.setRequestHeader('X-CSRF-Token', csrfToken);
    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
    // choix de accept pour forcer le serveur à renvoyer du json dans le retour de la requête 
    xhr.setRequestHeader('accept', 'application/json;charset=UTF-8');
    xhr.send(JSON.stringify(jsonData)); 
  }

  redButton.addEventListener('click', function(event) {
    sendAjaxRequest(event);
  });
  blueButton.addEventListener('click', function(event) {
    sendAjaxRequest(event);
    });

  // Récupére le currentTime lors du chargement de la vidéo
  video.addEventListener('loadedmetadata', getCurrentTime);
});
