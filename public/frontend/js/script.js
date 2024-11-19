/*-----------------------------------------------------------------------------------

 Template Name:Katie
 Template URI: themes.pixelstrap.net/katie/template
 Description: This is a social website
 Author: Pixelstrap
 Author URI: https://themeforest.net/user/pixelstrap

 ----------------------------------------------------------------------------------- */



/*====================
       Ratio js
   =======================*/



/*=====================
02.Tap to Top
==========================*/

window.addEventListener('scroll', function () {
    var tapTopElement = document.querySelector('.tap-top');
    if (window.scrollY > 600) {
        tapTopElement.classList.add('top');
    } else {
        tapTopElement.classList.remove('top');
    }
});

var tapTopElement = document.querySelector('.tap-top');
tapTopElement.addEventListener('click', function () {
    document.documentElement.scrollTop = 0;
    document.body.scrollTop = 0;
    return false;
});
/*============================
    03.toggle nav
 ============================*/

    // const toggleNav = document.getElementById('toggle-nav');
    // const mobileBack = document.getElementById('mobile-back');
    // const smHorizontal = document.getElementById('sm-horizontal');
    // toggleNav.addEventListener('click', function() {
    //     smHorizontal.classList.add('open');
    // });
    // mobileBack.addEventListener('click', function() {
    //     smHorizontal.classList.remove('open');
    // });

 
/*============================
        07.cart js 
============================*/




/*============================
           05.Tost js 
   ============================*/

document.querySelectorAll(".wishlist-icon").forEach(function (element) {
    element.addEventListener("click", function () {
        Toastify({
            text: "Success! Item Successfully added in wishlist.!!",
            duration: 2500,
            close: true,
        }).showToast();
        i++;
    });
});


/*====================
       footer according
   =======================*/

const footerButton = document.querySelectorAll(".footer-content h5");
const showNav = document.querySelector(".nav");
for (var i = 0; i < footerButton.length; ++i) {
    footerButton[i].addEventListener('click', function () {
        this.parentNode.classList.toggle('open');
    })
}



/*====================
       Wishlist card
   =======================*/
const wishlistProduct = document.querySelectorAll(".product-wishlist");
wishlistProduct.forEach(el => {
    const deleteButton = el.querySelector(".delete-button");
    deleteButton.addEventListener("click", function () {
        this.closest(".col").style.display = "none";
    });
});

  

/*====================
      Header responsive 
   =======================*/

document.addEventListener('DOMContentLoaded', () => {
    function handleNavClick(event) {
      const clickedElement = event.target.closest('li');
  
      if (clickedElement && !clickedElement.classList.contains('mobile-back')) {
        const isActive = clickedElement.classList.contains('show');
  
        // Remove 'show' class from all <li> elements
        document.querySelectorAll('#sm-horizontal li').forEach(li => {
          li.classList.remove('show');
          if (li.querySelector('.nav-link')) {
            li.querySelector('.nav-link').classList.remove('show');
          }
          if (li.querySelector('.mega-menu')) {
            li.querySelector('.mega-menu').classList.remove('show');
          }
          if (li.querySelector('.nav-submenu')) {
            li.querySelector('.nav-submenu').classList.remove('show');
          }
        });
  
        // If the clicked element didn't have the 'show' class, add it
        if (!isActive) {
          clickedElement.classList.add('show');
          if (clickedElement.querySelector('.nav-link')) {
            clickedElement.querySelector('.nav-link').classList.add('show');
          }
          if (clickedElement.querySelector('.mega-menu')) {
            clickedElement.querySelector('.mega-menu').classList.add('show');
          }
          if (clickedElement.querySelector('.nav-submenu')) {
            clickedElement.querySelector('.nav-submenu').classList.add('show');
          }
        }
      }
    }
  
    function handleResize() {
      if (window.innerWidth <= 1200) {
        document.getElementById('sm-horizontal').addEventListener('click', handleNavClick);
      } else {
        document.getElementById('sm-horizontal').removeEventListener('click', handleNavClick);
        // Remove 'show' class from all elements on resize above 1199px
        document.querySelectorAll('#sm-horizontal li').forEach(li => {
          li.classList.remove('show');
          if (li.querySelector('.nav-link')) {
            li.querySelector('.nav-link').classList.remove('show');
          }
          if (li.querySelector('.mega-menu')) {
            li.querySelector('.mega-menu').classList.remove('show');
          }
          if (li.querySelector('.nav-submenu')) {
            li.querySelector('.nav-submenu').classList.remove('show');
          }
        });
      }
    }
  
    // Initial check
    handleResize();
  
    // Attach resize event listener
    window.addEventListener('resize', handleResize);
});