import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
    const containLoaderElement = document.querySelector("#contain-loader");
    const loaderElement = document.querySelector("#loader");

    if (containLoaderElement) {
      containLoaderElement.style.display = "flex";
    }

    if (loaderElement) {
      loaderElement.style.display = "block";
    }
  });

  window.addEventListener("load", () => {
    const containLoaderElement = document.querySelector("#contain-loader");
    const loaderElement = document.querySelector("#loader");

    if (containLoaderElement) {
      containLoaderElement.style.display = "none";
    }

    if (loaderElement) {
      loaderElement.style.display = "none";
    }
  });

