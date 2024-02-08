let currentIndex = 0;
const images = document.querySelectorAll('#image-container img');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

function showImage(index) {
    images.forEach((img, i) => {
        img.classList.toggle('active', i === index);
    });

    if (index === 0) {
        nextBtn.style.color = 'blue';
        prevBtn.style.color = 'cornflowerblue';
    } else if (index === images.length - 1) {
        nextBtn.style.color = 'cornflowerblue';
        prevBtn.style.color = 'blue';
    } else {
        nextBtn.style.color = 'blue';
        prevBtn.style.color = 'blue';
    }
}

function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
}

function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage(currentIndex);
}

setInterval(nextImage, 3000); // Resimler her 3 saniyede bir değişecek.


var swiper = new Swiper(".mySwiper.my", {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        // 640: {
        //     slidesPerView: 4,
        //     spaceBetween: 20,
        // },
        // 768: {
        //     slidesPerView: 4,
        //     spaceBetween: 40,
        // },
        1024: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
    },
});

var swiper = new Swiper(".mySwiper.my2", {
    slidesPerView: 1,
    spaceBetween: 10,
    slidesPerGroup: 4,
    speed: 1000,
    autoplay: {
        delay: 2000, // 1 saniye
    },
    loop: true,
    pagination: {
        el: ".swiper-pagination.my2",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next.my2",
        prevEl: ".swiper-button-prev.my2",
    },
    breakpoints: {
        // 640: {
        //     slidesPerView: 4,
        //     spaceBetween: 20,
        // },
        // 768: {
        //     slidesPerView: 4,
        //     spaceBetween: 40,
        // },
        1024: {
            slidesPerView: 4,
            spaceBetween: 50,
        },
    },
});


let search1 = document.querySelector('.search1');
let search2 = document.querySelector('.search2');
let head1 = document.querySelector('.head1');
let head2 = document.querySelector('.head2');

search1.addEventListener('click', () => {
    fadeOut(head1, () => {
        head1.style.display = 'none';
        fadeIn(head2);
    });
});

search2.addEventListener('click', () => {
    fadeOut(head2, () => {
        head2.style.display = 'none';
        fadeIn(head1);
    });
});

function fadeOut(element, callback) {
    let opacity = 1;
    let timer = setInterval(() => {
        if (opacity <= 0.1) {
            clearInterval(timer);
            element.style.opacity = '0';
            if (typeof callback === 'function') callback();
        }
        element.style.opacity = opacity;
        opacity -= opacity * 0.1;
    }, 50);
}

function fadeIn(element, callback) {
    let opacity = 0;
    element.style.display = 'block';
    let timer = setInterval(() => {
        if (opacity >= 1) {
            clearInterval(timer);
            if (typeof callback === 'function') callback();
        }
        element.style.opacity = opacity;
        opacity += 0.1;
    }, 50);
}



function handleSmallScreen() {
    var iconNav = document.getElementById('iconNav');
    var iconMenu = document.querySelector('.iconMenu');
    var closeMenu = document.querySelector('.closeMenu');

    function toggleIconMenu() {
        iconMenu.hidden = !iconMenu.hidden;
    }
    function toggleCloseMenu() {
        iconMenu.hidden = true;
    }

    iconNav.addEventListener('click', toggleIconMenu);
    closeMenu.addEventListener('click', toggleCloseMenu);

    function toggleCategory() {
        this.classList.toggle('active');
        var toggle = this.querySelector('.toggle');
        toggle.innerHTML = this.classList.contains('active') ? '-' : '+';
        var ul = this.querySelector('ul');
        ul.classList.toggle('active');
    }

    var categories = document.querySelectorAll('.category');
    categories.forEach(category => {
        category.addEventListener('click', toggleCategory);
    });
}

function handleResize() {
    if (window.innerWidth <= 768) {
        handleSmallScreen();
    } else {
    }
}

window.addEventListener('resize', handleResize);

handleResize();

