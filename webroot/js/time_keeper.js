document.addEventListener("DOMContentLoaded", () => {
    // Calcul du assessmentId et de l'élément video a suivre
    assessmentId = window.location.pathname.split("/").slice(-1);
    video = document.getElementById("video");
    key = "assessmentCurrentTime-" + assessmentId;
    const offset = parseInt(video.getAttribute("data-offset"));

    // Initialise le currentTime avec l'offset
    if (localStorage.getItem(key) === null && video.currentTime === 0) {
        localStorage.setItem(key, offset);
    }

    // une fois au chargement.
    if (localStorage.getItem(key) !== null) {
        video.currentTime = localStorage.getItem(key);
    }
    // et sinon on stocke en permanence
    video.addEventListener("timeupdate", () => {
        localStorage.setItem(key, video.currentTime);
    });
    video.addEventListener("ended", () => {
        document.location.href = video.dataset.nextVideo;
    });
});
