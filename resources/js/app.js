import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
    showLoader();
    showContainLoader();
});

function showLoader() {
    const loaderElement = document.querySelector("#loader");

    if (loaderElement) {
        loaderElement.style.display = "block"; // Mostrar el loader
    }
}

function showContainLoader() {
    const containLoaderElement = document.querySelector("#contain-loader");

    if (containLoaderElement) {
        containLoaderElement.style.display = "flex"; // Mostrar el contenedor del loader
    }
}

window.addEventListener("load", () => {
    hideLoader();
    hideContainLoader();
});

function hideLoader() {
    const loaderElement = document.querySelector("#loader");

    if (loaderElement) {
        loaderElement.style.display = "none"; // Ocultar el loader
    }
}

function hideContainLoader() {
    const containLoaderElement = document.querySelector("#contain-loader");

    if (containLoaderElement) {
        containLoaderElement.style.display = "none"; // Ocultar el contenedor del loader
    }
}
