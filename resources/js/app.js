import './bootstrap';

function showLoader() {
    const loaderElement = document.querySelector('#loader');
    
    loaderElement.style.display = 'block'; // Mostrar el loader

    // Ocultar el loader después de 4 segundos
    setTimeout(() => {
        loaderElement.style.display = 'none';
    }, 2000); // 4000 ms = 4 segundos
}

// Llama a la función para mostrar el loader
showLoader();

function showContainLoader() {
  const containLoaderElement = document.querySelector('#contain-loader');
  
  containLoaderElement.style.display = 'flex'; // Mostrar el contenedor del loader

  // Ocultar el contenedor del loader después de 2 segundos
  setTimeout(() => {
      containLoaderElement.style.display = 'none';
  }, 2000); // 2000 ms = 2 segundos
}

// Llama a la función para mostrar el contenedor del loader
showContainLoader();

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
