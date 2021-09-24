window.addEventListener('DOMContentLoaded', event => {
    // Navbar shrink function
    var dashbarShrink = function () {
        const dashbarCollapsible = document.body.querySelector('#dashNav');
        if (!dashbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            dashbarCollapsible.classList.add('navbar-shrink');
            $('meta[name=theme-color]').attr('content', '#f8f9fa');
        } else {
            dashbarCollapsible.classList.remove('navbar-shrink');
            $('meta[name=theme-color]').attr('content', '#ffffff');
        }
    };
    // Shrink the navbar 
    dashbarShrink();
    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', dashbarShrink);
}); 