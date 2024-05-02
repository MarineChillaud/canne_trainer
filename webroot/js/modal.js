fixconsole.log("Le code modal.js est exécuté");

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const modalText = document.getElementById("modal-text");
    const countDownElement = document.getElementById("countdown");

    modal.style.display = "block";
    modalText.textContent = "Nouvelle évaluation";

    let countdown = 3;

    const updateCountDown = () => {
        countDownElement.textContent = countdown;

        if (countdown === 0) {
            modal.style.display = "none";
        } else {
            countdown--;
            setTimeout(updateCountDown, 1000);
        }
    };
    updateCountDown();
});
