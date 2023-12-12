document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("video").addEventListener("loadeddata", () => {
        const video = document.querySelector("video");

        document.querySelectorAll(".point-flag").forEach((element) => {
            const time = element.dataset.time;
            const duration = video.duration;
            const pc = Math.floor((100 * time) / duration);
            element.style.left = pc + "%";
        });

        document.querySelectorAll(".point-flag").forEach((element) => {
            element.addEventListener("click", () => {
                video.cur = Math.floor(element.dataset.time);
            });
        });
        console.log("ready!");
    });
});
