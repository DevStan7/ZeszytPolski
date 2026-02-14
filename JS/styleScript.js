
const letters = "AĄBCĆDEĘFGHIJKLŁMNŃOÓPRSŚTUVWXYZŹŻ";
const container = document.querySelector(".letters-bg");

for(let i = 0; i < 40; i++){

    const span = document.createElement("span");
    span.classList.add("letter");

    // losowa litera
    span.textContent = letters[Math.floor(Math.random() * letters.length)];

    // losowa pozycja
    span.style.left = Math.random() * 100 + "vw";
    span.style.top = Math.random() * 100 + "vh";

    // losowy rozmiar
    span.style.fontSize = (15 + Math.random() * 35) + "px";

    // losowy czas animacji
    span.style.animationDuration = (8 + Math.random() * 10) + "s";

    container.appendChild(span);
}