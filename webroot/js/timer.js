document.addEventListener("DOMContentLoaded", function () {
    let video = document.getElementById("video");
    let redButton = document.getElementById("redButton");
    let blueButton = document.getElementById("blueButton");
    let redCurrentTimeInput = document.getElementById("current_time_red");
    let blueCurrentTimeInput = document.getElementById("current_time_blue");
    let progressBar = document.getElementById("progressBar");

    function updateProgressBar() {
        let progress = (video.currentTime / video.duration) * 100;
        progressBar.style.width = progress + "%";
    }

    function getCurrentTime() {
        redCurrentTimeInput.value = video.currentTime;
        blueCurrentTimeInput.value = video.currentTime;
    }

    function handlePlayerEvent() {
        getCurrentTime();
    }

    function handleTimeUpdateEvent() {
        updateProgressBar();
    }

    video.addEventListener("play", handlePlayerEvent);
    video.addEventListener("pause", handlePlayerEvent);
    video.addEventListener("timeupdate", handleTimeUpdateEvent);
    video.addEventListener("click", function () {
        if (video.paused) {
            video.play();
        } else {
            video.pause();
        }
    });

    let xhr = new XMLHttpRequest();

    function alertContent() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                // Mettre à jour les boutons rouges et bleus avec les nouveaux scores
                redButton.textContent = response.scores.red;
                blueButton.textContent = response.scores.blue;

                const flagContainer = document.getElementById("flagContainer");
                flagContainer.innerHTML = "";

                for (let point of response.flagPoints) {
                    let flag = document.createElement("div");
                    flag.className =
                        point.color === "red"
                            ? "red point-flag"
                            : "blue point-flag";
                    let flagPosition = (point.timing / video.duration) * 100;
                    flag.style.left = flagPosition + "%";
                    flagContainer.appendChild(flag);
                }
            } else {
                console.error("Il y a eu un soucis avec la requête");
            }
        }
    }

    function sendAjaxRequest(event) {
        event.preventDefault();
        getCurrentTime(); //??
        let sourceForm = event.target.parentNode;
        sourceForm.querySelector("input[name='current_time']").value =
            video.currentTime;
        let sourceFormAction = sourceForm.getAttribute("action");
        let sourceFormData = new FormData(sourceForm);

        let jsonData = {};
        sourceFormData.forEach((value, key) => {
            jsonData[key] = value;
        });

        xhr.onreadystatechange = alertContent;
        xhr.open("POST", sourceFormAction, true);
        xhr.setRequestHeader("X-CSRF-Token", csrfToken);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        // choix de accept pour forcer le serveur à renvoyer du json dans le retour de la requête
        xhr.setRequestHeader("accept", "application/json;charset=UTF-8");
        xhr.send(JSON.stringify(jsonData));
    }

    document.addEventListener("keydown", (event) => {
        if (event.code === "KeyA") {
            redButton.click();
        }

        if (event.code === "Semicolon") {
            blueButton.click();
        }
    });

    redButton.addEventListener("click", (event) => {
        sendAjaxRequest(event);
    });
    blueButton.addEventListener("click", (event) => {
        sendAjaxRequest(event);
    });

    // Récupére le currentTime lors du chargement de la vidéo
    video.addEventListener("loadedmetadata", () => {
        getCurrentTime();
    });
});
