document.addEventListener('DOMContentLoaded', function() {
  let video = document.querySelector('video');
  let redButton = document.getElementById('redButton');
  let blueButton = document.getElementById('blueButton');
  let redCurrentTimeInput = document.getElementById('current_time_red');
  let blueCurrentTimeInput = document.getElementById('current_time_blue');

  console.log('video: ', video);
  console.log('redButton: ',redButton);
  console.log('buleButton: ', blueButton);
  console.log('redCurrentTimeInput: ', redCurrentTimeInput);
  console.log('blueCurrentTimeInput: ', blueCurrentTimeInput);

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
    if(xhr.readyState === 4){
      if (xhr.status === 200) {
      console.log(xhr.responseText);

      const response = JSON.parse(xhr.responseText);
        if (response.points.red) {
          console.log('redButton :', redButton);
          console.log('blueButton :', blueButton);
          // Mettre à jour les boutons rouges et bleus avec les nouveaux points
          redButton.textContent = response.points.red;
          blueButton.textContent = response.points.blue;
        } else {
          console.log('Erreur lors de l\'enregistrement du point');
        }
      } else {
      console.log('Il y a eu un soucis avec la requête');
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
   // let encodedData = new URLSearchParams(sourceFormData).toString();
   // console.log(sourceFormData);

   let jsonData = {};
   sourceFormData.forEach((value, key) => {
    jsonData[key] = value;
   });

    xhr.onreadystatechange = alertContent;
    xhr.open('POST', sourceFormAction, true);
    xhr.setRequestHeader('X-CSRF-Token', csrfToken);
    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
    xhr.setRequestHeader('accept', 'application/json;charset=UTF-8');
    //xhr.responseType = 'json';    
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
