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


// ===== header ====== //
window.addEventListener('scroll', function () {
    if (window.scrollY > 300) {
        document.querySelector('header').classList.add('sticky');
    } else {
        document.querySelector('header').classList.remove('sticky');
    }
});


const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

     
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
             
            navLinks.forEach(link => link.classList.remove('active'));

            
            this.classList.add('active');
        });
    });

