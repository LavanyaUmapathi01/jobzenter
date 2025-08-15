(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner(0);
    
    
    // Initiate the wowjs
    new WOW().init();
    
    
   // Back to top button
   $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Blog carousel
    $(".blog-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: false,
        loop: true,
        margin: 50,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });


    // Testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        center: true,
        dots: true,
        loop: true,
        margin: 50,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsiveClass: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });

})(jQuery);


// terms 

// JavaScript can be added here if needed for additional functionality
document.addEventListener("DOMContentLoaded", function() {
    console.log("Terms and Conditions page loaded");
});

// terms 

/* privacy policy  */ 

// JavaScript can be added here if needed for additional functionality
document.addEventListener("DOMContentLoaded", function() {
    console.log("Privacy Policy page loaded");
});


/* privacy policy  */




// // email js code 


document.getElementById('downloadForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch('send_email.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Always show success message using SweetAlert and allow download
        Swal.fire({
            icon: 'warning', // Use warning icon to match yellow color
            title: 'Your brochure has been successfully downloaded!',
            text: 'Press OK to view the brochure.',
            confirmButtonColor: '#FFC107', // Yellow color for the button
            confirmButtonText: 'OK'
        }).then(() => {
            // Show download section and trigger the download
            document.getElementById('downloadSection').style.display = 'block';
            document.getElementById('downloadButton').setAttribute('href', './pdfs/' + data.pdfFileName);
            document.getElementById('downloadButton').click();
        });
    })
    .catch(error => {
        // Even if there is an error, show the success message using SweetAlert and allow download
        Swal.fire({
            icon: 'warning', // Use warning icon to match yellow color
            title: 'Your brochure has been successfully downloaded!',
            text: 'Press OK to view the brochure.',
            confirmButtonColor: '#FFC107', // Yellow color for the button
            confirmButtonText: 'OK'
        }).then(() => {
            // Show download section and trigger the download
            document.getElementById('downloadSection').style.display = 'block';
            document.getElementById('downloadButton').setAttribute('href', './pdfs/' + document.getElementById('pdfFileName').value);
            document.getElementById('downloadButton').click();
        });

        console.error('Error:', error); // Log the error for debugging purposes
    });
});


// // email js code 



/* <!-- pop up of boot camp --> */

// Show the popup when the page loads
window.onload = function() {
    var modal = document.getElementById("popupModal");
    modal.style.display = "block";
  }
  
  // Close the popup when the user clicks on <span> (x)
  document.querySelector(".popup-modal .close").onclick = function() {
    var modal = document.getElementById("popupModal");
    modal.style.display = "none";
  }

  
  /* <!-- pop up of boot camp --> */


