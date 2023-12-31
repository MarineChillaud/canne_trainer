document.addEventListener('DOMContentLoaded', () => {

    // affichage de tous les assessements et des pointt
    document.getElementById('video').addEventListener('loadeddata', () => {
        const video = document.querySelector('video');
        const duration = video.duration;

        document.querySelectorAll('.point-flag').forEach((element) => {
            const time = element.dataset.time;
            const pc = Math.floor((100 * time) / duration);
            element.style.left = pc + '%';
        });

        document.querySelectorAll('.point-flag').forEach((element) => {
            element.addEventListener('click', () => {
                const clickedTime = parseInt(element.dataset.time, 10);
                const newTime = Math.max(0, clickedTime - 3);

                video.currentTime = newTime;
            });
        });
    });
});
