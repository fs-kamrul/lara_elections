
// Get the button
const mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
const appMenuButton = document.getElementById('appMenuButton');
const appMenuDropdown = document.getElementById('appMenuDropdown');
const appMenuContainer = document.getElementById('appMenuContainer');

appMenuButton.addEventListener('click', (e) => {
    e.stopPropagation();
    const isHidden = appMenuDropdown.classList.contains('hidden');

    if (isHidden) {
        appMenuDropdown.classList.remove('hidden');
        appMenuButton.classList.add('bg-gray-100');
    } else {
        appMenuDropdown.classList.add('hidden');
        appMenuButton.classList.remove('bg-gray-100');
    }
});

document.addEventListener('click', (e) => {
    if (!appMenuContainer.contains(e.target)) {
        appMenuDropdown.classList.add('hidden');
        appMenuButton.classList.remove('bg-gray-100');
    }
});
const scrollFunction = () => {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.classList.remove("hidden");
  } else {
    mybutton.classList.add("hidden");
  }
};
const backToTop = () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
};

// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

window.addEventListener("scroll", scrollFunction);

// Copy partner logo
var copy = document.querySelector(".logos-slide").cloneNode(true);
document.querySelector(".logos").appendChild(copy);

// Slider
let parent = document.querySelector("#customize-thumbnails");
let childCount = document.querySelector(
    "#customize-thumbnails",
).childElementCount;
let childs = parent.children;
let midchild;

let firstChild = parent.firstElementChild;

let firstList = firstChild.classList;
firstList.remove("lg:!w-60", "lg:!h-60", "lg:!max-h-60");
firstList.add("lg:!w-10", "lg:!h-10", "lg:!max-h-10");

let lastChild = parent.lastElementChild;

let lastList = lastChild.classList;
lastList.remove("lg:!w-60", "lg:!h-60", "lg:!max-h-60");
lastList.add("lg:!w-10", "lg:!h-10", "lg:!max-h-10");

if (childCount !== 0) {
    midchild = childs[Math.ceil(childCount / 2 - 1)];
} else {
    midchild = childs[childCount / 2];
}

let list = midchild.classList;
list.add("lg:center_element");
list.remove("lg:!w-60", "lg:!h-60", "lg:!max-h-60");

let centerElement = document.querySelector(".center_element");

var centerElementIndex = Array.from(parent.children).indexOf(
    centerElement,
);

var slider = tns({
  container: "#customize",
  items: 1,
  slideBy: "page",
  autoplay: false,
  mouseDrag: true,
  speed: 400,
  navContainer: "#customize-thumbnails",
  navAsThumbnails: true,
  controls: false,
  startIndex: centerElementIndex,
});



// other js

// Mobile Menu Toggle
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenuClose = document.getElementById('mobile-menu-close');
const mobileMenu = document.getElementById('mobile-menu');

function closeMobileMenu() {
    document.body.classList.remove('mobile-menu-open');
}

mobileMenuButton.addEventListener('click', () => {
    console.log('Menu button clicked'); // Debugging log
    document.body.classList.toggle('mobile-menu-open');
});

mobileMenuClose.addEventListener('click', () => {
    console.log('Close button clicked'); // Debugging log
    closeMobileMenu();
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    if (document.body.classList.contains('mobile-menu-open')) {
        const clickedInsideMenu = mobileMenu.contains(e.target);
        const clickedMenuButton = mobileMenuButton.contains(e.target);

        if (!clickedInsideMenu && !clickedMenuButton) {
            console.log('Clicked outside menu'); // Debugging log
            closeMobileMenu();
        }
    }
});

// Mobile Dropdowns
const mobileDropdownButtons = document.querySelectorAll('.mobile-dropdown-button');
mobileDropdownButtons.forEach(button => {
    button.addEventListener('click', () => {
        const parent = button.parentElement;
        parent.classList.toggle('mobile-dropdown-open');

        // Toggle icon
        const icon = button.querySelector('i');
        if (parent.classList.contains('mobile-dropdown-open')) {
            icon.classList.replace('ri-arrow-down-s-line', 'ri-arrow-up-s-line');
        } else {
            icon.classList.replace('ri-arrow-up-s-line', 'ri-arrow-down-s-line');
        }
    });
});

// Mobile Nested Dropdowns
const mobileNestedButtons = document.querySelectorAll('.mobile-nested-button');
mobileNestedButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.stopPropagation();
        const parent = button.parentElement;
        parent.classList.toggle('mobile-nested-open');

        // Toggle icon
        const icon = button.querySelector('i');
        if (parent.classList.contains('mobile-nested-open')) {
            icon.classList.replace('ri-arrow-down-s-line', 'ri-arrow-up-s-line');
        } else {
            icon.classList.replace('ri-arrow-up-s-line', 'ri-arrow-down-s-line');
        }
    });
});

// Mobile Third Level Dropdowns
const mobileThirdButtons = document.querySelectorAll('.mobile-third-button');
mobileThirdButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.stopPropagation();
        const parent = button.parentElement;
        parent.classList.toggle('mobile-third-open');

        // Toggle icon
        const icon = button.querySelector('i');
        if (parent.classList.contains('mobile-third-open')) {
            icon.classList.replace('ri-arrow-down-s-line', 'ri-arrow-up-s-line');
        } else {
            icon.classList.replace('ri-arrow-up-s-line', 'ri-arrow-down-s-line');
        }
    });
});
