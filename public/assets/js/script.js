window.addEventListener('scroll', function() {
  var header = document.querySelector('header');
  header.classList.toggle('header-scroll', window.scrollY > 0);
});

window.addEventListener('scroll', function() {
  var signupButton = document.getElementById('signUpIndex');
  if (window.pageYOffset > 400) {
    signupButton.style.display = 'block';
  } else {
    signupButton.style.display = 'none';
  }
});
 

//Accordion

const accordion = document.getElementsByClassName('accordion-container');

for (i=0; i<accordion.length; i++) {
  accordion[i].addEventListener('click', function () {
    this.classList.toggle('active')
  })
}

//Show-Hide Mobile-Menu

function openNav() {
  document.getElementById("mobile-fullscrenMenu").style.width = "100%";
  var overlay = document.querySelector('.overlay');
  overlay.style.visibility = 'visible';
  var elements = document.querySelectorAll("#mobile-fullscrenMenu *");
  for (var i = 0; i < elements.length; i++) {
    elements[i].style.visibility = "visible";
  }
}

function closeNav() {
  document.getElementById("mobile-fullscrenMenu").style.width = "0%";
  var elements = document.querySelectorAll("#mobile-fullscrenMenu *");
  for (var i = 0; i < elements.length; i++) {
    elements[i].style.visibility = "hidden";
  }
  
}

