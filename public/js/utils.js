

// change header height when scrolling
function scrollFunction() {
    let header = document.querySelector("[data-header]");
    let main = document.querySelector("[data-main]").offsetTop;
    let imageLogo = document.querySelector("[data-image-logo]");

    if (document.body.scrollTop > main || document.documentElement.scrollTop > main) {
        header.classList.add("header-scrolled");
        imageLogo.classList.add("image-scrolled");
    } else {
        header.classList.remove("header-scrolled");
        imageLogo.classList.remove("image-scrolled");
    }
}

window.onscroll = () => scrollFunction();