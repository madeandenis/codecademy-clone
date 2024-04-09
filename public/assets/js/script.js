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

//QuizJS

// Array of quiz questions
const quizQuestions = [
  {
      question: "To insert JavaScript code into an HTML page, which tag is used?",
      options: [
          "<javascript>",
          "<js>",
          "<script>"
      ],
      answer: 2 
  },

  {
    question: "JavaScript ignores extra white spaces.",
    options: [
        "True",
        "False",
    ],
    answer: 0
  },

  {
    question: "How do you declare a new date in JavaScript?",
    options: [
        "var date = Date();",
        "var date = date('now');",
        "var date = new Date();",
        "var date = date().current();"
    ],
    answer: 2 
  },

  {
    question: "How do you write something to the web page using JavaScript?",
    options: [
        "window.write(...)",
        "window.page.write(...)",
        "document.write(...)",
    ],
    answer: 2 
  },

  {
    question: "How do you get the DOM element with a specific id in JavaScript?",
    options: [
        "window.getElementById(...)",
        "page.getElementById(...)",
        "document.innerHTML.getElementById(...)",
        "document.getElementById(...)",
    ],
    answer: 3 
  },

  {
    question: "Can you set any style for an HTML tag using JavaScript?",
    options: [
        "Yes",
        "No",
    ],
    answer: 0
  },

  {
    question: "Which of the following is used to check if a variable is an array?",
    options: [
        "===",
        "typeof",
        "isarrayType()",
        "==",
    ],
    answer: 2 
  },

  {
    question: "Which function is used to load the next URL from the history list?",
    options: [
        "window.history.next();",
        "window.history.load_next();",
        "window.history.forward();",
        "window.history.load_forward();"
    ],
    answer: 2 
  },
];


var colors = ["#FF881D","#47CCA0","#917EF2","#D957D9","#FFD500","#FD4D3F","#FFBFFA","#5788FA"];

let currentQuestion = 0;
let guessedAns = 0;

// Initializare Quiz
function startQuiz() {
  displayQuestion();
  attachButtonListeners();
}

// Current Question
function displayQuestion() {
  const currentQuestionData = quizQuestions[currentQuestion];
  document.getElementById("question-number").textContent = `${currentQuestion + 1}/${quizQuestions.length}`;
  document.getElementById("question").textContent = currentQuestionData.question;
  const answerButtons = document.querySelector(".answer-buttons").getElementsByTagName("button");

  // Hide the buttons
  for (let i = 0; i < answerButtons.length; i++) {
    answerButtons[i].style.display = "none";
  }

  // Display them
  for (let i = 0; i < currentQuestionData.options.length; i++) {
    answerButtons[i].textContent = currentQuestionData.options[i];
    answerButtons[i].style.display = "block";
  }

  // Randomly select a color from the colors array
  
  const randomColor = colors[Math.floor(Math.random() * colors.length)];
  document.querySelector(".quiz-questions-container").style.backgroundColor = randomColor;
}

// Clickable Buttons
function attachButtonListeners() {
  const answerButtons = document.querySelector(".answer-buttons").getElementsByTagName("button");
  for (let i = 0; i < answerButtons.length; i++) {
    answerButtons[i].addEventListener("click", handleAnswer);
  }
}

// AnswersOutcome
function handleAnswer(event) { 
  const selectedAnswer = event.target.id;
  const currentQuestionData = quizQuestions[currentQuestion];
  // Get the ID of the selected answer option
  const selectedOptionID = `option${currentQuestionData.answer + 1}`;
  const isCorrect = (selectedAnswer ==  selectedOptionID);
  if (isCorrect) {
    event.target.style.backgroundColor = "rgb(78, 138, 50)";
    guessedAns += 1;
  } else {
    event.target.style.backgroundColor = "rgb(189, 38, 38)";
  }
  disableButtons();
  setTimeout(goToNextQuestion, 1000);

  localStorage.setItem("guessedAns", guessedAns);
}

function disableButtons() {
  const answerButtons = document.querySelector(".answer-buttons").getElementsByTagName("button");
  for (let i = 0; i < answerButtons.length; i++) {
    answerButtons[i].disabled = true;
  }
}

function enableButtons() {
  const answerButtons = document.querySelector(".answer-buttons").getElementsByTagName("button");
  for (let i = 0; i < answerButtons.length; i++) {
    answerButtons[i].disabled = false;
    answerButtons[i].style.backgroundColor = "";
  }
}

function goToNextQuestion() {
  enableButtons();
  currentQuestion++;
  if (currentQuestion < quizQuestions.length) {
    displayQuestion();
  } else {
    window.location.href = "http://localhost/demo/JavaCourseSite";
  }
}

//Apelam functia
startQuiz();
