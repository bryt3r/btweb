//menu hider
const menu = document.querySelector('#menu_icon');
const navLinks = document.querySelector('#nav_toggle');
if (menu) {
  menu.addEventListener('click', () => {
    navLinks.classList.toggle('mobile_nav');
  });
}


//dashmenu hider
const dash_menu_icon = document.querySelector('#dash_menu_icon');
const side_nav = document.querySelector('#dash_nav_toggle');
if (dash_menu_icon) {
  dash_menu_icon.addEventListener('click', () => {
    side_nav.classList.toggle('display_dash_nav');
  });

}





// Product image slideshow
function showSlide(n) {
  let i;
  let slides = document.getElementsByClassName("imageSlide");
  let thumbs = document.getElementsByClassName("imageThumb");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < thumbs.length; i++) {
    thumbs[i].className = thumbs[i].className.replace(" activeThumb", "");
  }
  slides[n - 1].style.display = "block";
  thumbs[n - 1].className += " activeThumb";
}
// Product image slideshow


// Modal
// Get the modal
const modals = document.querySelectorAll("#modal");
// Get the button that opens the modal
const open_btns = document.querySelectorAll("#modal_open_btn");
// Get the <span> element that closes the modal
const closeBtns = document.querySelectorAll(".modal_close_btn");

// When the user clicks the button, open the modal of that button

open_btns.forEach((btn, i) => {
  btn.addEventListener('click', () => {
    modals[i].style.display = "block";
  })
});


// When the user clicks on <span> (x), close the modal
closeBtns.forEach((closeBtn, i) => {
  closeBtn.addEventListener('click', () => {
    modals[i].style.display = "none";
  })
});


// When the user clicks anywhere outside of the modal, close it
modals.forEach(modal => {
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});

// Modal Ends


//image html copier
function copyImageHtml(imageId, textId) {
  /* Get the text field */
  var imageField = document.getElementById(imageId);
  var textField = document.getElementById(textId);
  textField.value = imageField.outerHTML;
  /* Select the text field */
  textField.select();
  textField.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  if (window.isSecureContext && navigator.clipboard) {
    navigator.clipboard.writeText(textField.value);
  } else {
    try {
      document.execCommand('copy');
    } catch (err) {
      console.error('Unable to copy to clipboard', err);
    }
  }
  alert(textField.value);
  /* Alert the copied text */
  // alert("Copied the text: " + copyText.value);
}



// Solar Hero image slide
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("slide_container");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) { slideIndex = 1 }
  if (slides[slideIndex - 1]) {
    slides[slideIndex - 1].style.display = "block";
  }

  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
// Solar Hero image slide




function flipCard() {
  let i;
  let boxes = document.querySelectorAll(".package_card");
  let cards = document.querySelectorAll(".package_card");

  boxes.forEach((box, i) => {
    var degrees = 0;
    box.addEventListener('click', function () {
      if (degrees > 180) {
        degrees = 0;
      }
      degrees += 180;
      cards[i].style.transform = "rotateY(" + degrees + "deg)";
      cards[i].style.webkitTransform = "rotateY(" + degrees + "deg)";
      cards[i].style.MozTransform = "rotateY(" + degrees + "deg)";
      cards[i].style.msTransform = "rotateY(" + degrees + "deg)";
      cards[i].style.OTransform = "rotateY(" + degrees + "deg)";
      cards[i].style.transform = "rotateY(" + degrees + "deg)";
    });
  });


}

window.onload = flipCard;