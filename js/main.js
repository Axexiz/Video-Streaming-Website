
const activePage = window.location;
console.log(activePage.pathname);
const navlinks = document.querySelectorAll('.navlink').forEach
    (link => {
        const href = link.href.split('#')[0];
        if (href.includes(activePage.pathname)) {
            link.classList.add('active2');
        }
    });


function toggleActiveClass() {
    this.closest(".select-menu").classList.toggle("active3");
}

// Function to remove the "active3" class from the selectMenu element
function removeActiveClass() {
    this.querySelector(".select-menu").classList.remove("active3");
}

// Get all the swiper-slide elements
const swiperSlides = document.querySelectorAll(".slider-box");

// Iterate through each swiper-slide element
swiperSlides.forEach((slide) => {
    // Get the selectBtn element within the current swiper-slide
    const selectBtn = slide.querySelector(".select-btn");

    // Attach the click event listener to the selectBtn element
    selectBtn.addEventListener("click", toggleActiveClass);

    // Attach the mouseleave event listener to the swiper-slide element
    slide.addEventListener("mouseleave", removeActiveClass);
});


function menuToggle() {
    const toggleMenu = document.querySelector('.menu');
    toggleMenu.classList.toggle('act')
}

document.addEventListener("click", function (event) {
    const profile = document.querySelector('.PPC');
    const toggleMenu = document.querySelector('.menu');
    if (!profile.contains(event.target)) {
        toggleMenu.classList.remove('act');
    }
})

function show() {
    document.querySelector('.hamburger').classList.toggle('open')
    document.querySelector('.nav-slider').classList.toggle('active')
}

function showMenu() {
    document.body.classList.toggle("menu-open");
}

function showFilter() {
    document.querySelector('.filter-form').classList.toggle('showForm');
}
