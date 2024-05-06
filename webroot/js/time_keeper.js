document.addEventListener("DOMContentLoaded", () => {
    // Calcul du assessmentId et de l'élément video a suivre
    assessmentId = window.location.pathname.split("/").slice(-1);
    video = document.getElementById("video");
    key = "assessmentCurrentTime-" + assessmentId;
    const offset = parseInt(video.getAttribute("data-offset"));

    // Initialise le currentTime avec l'offset initial
    video.currentTime = offset;

    // Initialise le localStorage avec l'offset initial
    localStorage.setItem(key, offset);

    // une fois au chargement.
    if (localStorage.getItem(key) !== null) {
        video.currentTime = localStorage.getItem(key);
    }
    // et sinon on stocke en permanence
    video.addEventListener("timeupdate", () =>
        localStorage.setItem(key, video.currentTime)
    );
    video.addEventListener("ended", () => {
        document.location.href = video.dataset.nextVideo;
    });
});

// document.addEventListener("DOMContentLoaded", () => {
//     // Calcul de l'assessmentId et de l'élément video à suivre
//     const assessmentId = window.location.pathname.split("/").slice(-1)[0];
//     const video = document.getElementById("video");
//     const key = "assessmentCurrentTime-" + assessmentId;
//     const offset = parseInt(video.getAttribute("data-offset"));

//     // Initialise currentTime avec l'offset
//     video.currentTime = offset;

//     // Met à jour le localStorage avec le currentTime de la vidéo
//     video.addEventListener("timeupdate", () => {
//         localStorage.setItem(key, video.currentTime);
//     });

//     // Redirection vers la prochaine vidéo lorsque celle-ci est terminée
//     video.addEventListener("ended", () => {
//         document.location.href = video.dataset.nextVideo;
//     });
// });
