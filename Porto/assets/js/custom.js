$(document).ready(function() {

    
  
    var app = $.spapp({pageNotFound : 'error_404'}); // initialize
  
    // define routes
    app.route({view: 'home', load: 'home.html'});

    app.route({view: 'aboutus', load: 'aboutus.html' });

    app.route({view: 'chefs', load: 'chefs.html' });

    app.route({view: 'menu', load: 'menu.html' });

    app.route({view: 'contact', load: 'contact.html' });

    app.route({view: 'reservation', load: 'reservation.html' });

    // run app
    app.run();
  
  });