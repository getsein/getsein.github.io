
const navbarHeight = $('#navbar').outerHeight();
$('.navbar ul li a').click(function () {
    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top - navbarHeight
    }, 100);
    return false;
});
/*

let isActive = false;

$('.js-menu').on('click', function() {
	if (isActive) {
		$(this).removeClass('active');
		$('body').removeClass('menu-open');
	} else {
		$(this).addClass('active');
		$('body').addClass('menu-open');
	}

	isActive = !isActive;
});
*/

/*NUEVO*/ 
var menu = document.querySelector('.hamburger');

// method
function toggleMenu (event) {
    this.classList.toggle('is-active');
    document.querySelector( ".menuppal" ).classList.toggle("is_active");
    event.preventDefault();
  }
  
  // event
  menu.addEventListener('click', toggleMenu, false);

/* TOP */
let topDos = $(".topDos");
let topDosIndex = -1;

function showNextTop(){
    ++topDosIndex;
    topDos.eq(topDosIndex % topDos.length)
    .fadeIn(400)
    .delay(600)
    .fadeOut(800, showNextTop);
}

showNextTop();

