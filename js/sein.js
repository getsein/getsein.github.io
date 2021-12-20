
 const navbarHeight = $('#navbar').outerHeight();

        $('.navbar ul li a').click(function () {
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - navbarHeight
            }, 100);
            return false;
  });
