// js/heart-change.js

document.addEventListener("DOMContentLoaded", () => {
    // Gérer tous les like1
    const likes1 = document.querySelectorAll(".like1");
    likes1.forEach(img => {
        img.addEventListener("click", () => {
            if (img.src.includes("like-vide.png")) {
                img.src = "image/like-rempli.png";
            } else {
                img.src = "image/like-vide.png";
            }
        });
    });

    // Gérer tous les like2
    const likes2 = document.querySelectorAll(".like2");
    likes2.forEach(img => {
        img.addEventListener("click", () => {
            if (img.src.includes("like-vide.png")) {
                img.src = "../image/like-rempli.png";
            } else {
                img.src = "../image/like-vide.png";
            }
        });
    });
});
