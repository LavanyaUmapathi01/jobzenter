// Show the loading screen for a short time, then show the main content
window.onload = function() {
    setTimeout(function() {
        document.getElementById('loading-screen').style.display = 'none';
        document.getElementById('quiz-container').classList.remove('hidden');
    }, 2000); // 2-second delay before showing the main content
};

// Handle form submission for user details
document.getElementById('quizForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    // Send form data to PHP for email processing
    fetch('quiz_mail.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Change the background and start the quiz
            startQuiz(); 
        } else {
            alert(data.message || 'An error occurred while sending the email.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while sending the email.');
    });
});

// Quiz JavaScript codes
const questions = [
    {
        question: "1. What does 'HTML' stand for?",
        options: ["Hypertext Markup Language", "Hyperlink Tool Markup Language", "Home Tool Markup Language", "Hyperlink Transfer Markup Language"],
        correct: 0
    },
    {
        question: "2. What does 'CSS' stand for?",
        options: ["Cascading Style Sheets", "Colorful Style Sheets", "Creative Style System", "Computer Style Sheets"],
        correct: 0
    },
    {
        question: "3. Which of these is a JavaScript framework?",
        options: ["Django", "Flask", "React", "Laravel"],
        correct: 2
    },
    {
        question: "4. Which language is used for styling web pages?",
        options: ["HTML", "JQuery", "CSS", "XML"],
        correct: 2
    },
    {
        question: "5. What does 'PHP' stand for?",
        options: ["Hypertext Preprocessor", "Pretext Hypertext Processor", "Personal Home Page", "Programming Hypertext Processor"],
        correct: 0
    },
    {
        question: "6. What is a correct way to write a JavaScript array?",
        options: ["var colors = (1:'red', 2:'green', 3:'blue')", "var colors = ['red', 'green', 'blue']", "var colors = 'red', 'green', 'blue'", "var colors = 1 = ('red'), 2 = ('green'), 3 = ('blue')"],
        correct: 1
    },
    {
        question: "7. What does 'SQL' stand for?",
        options: ["Structured Query Language", "Structured Question Language", "Style Query Language", "Statement Query Language"],
        correct: 0
    },
    {
        question: "8. Which of the following is a backend language?",
        options: ["HTML", "Python", "CSS", "React"],
        correct: 1
    },
    {
        question: "9. Which of the following is not a database?",
        options: ["MySQL", "MongoDB", "Oracle", "React"],
        correct: 3
    },
    {
        question: "10. Which of these is not a frontend technology?",
        options: ["HTML", "CSS", "JavaScript", "Node.js"],
        correct: 3
    }
];

let currentQuestionIndex = 0;
let score = 0;
let selectedOptionIndex = null;

function startQuiz() {
    // Change background image for the quiz page
    document.getElementById('quiz-body').style.backgroundImage = "url('img/quizpage.jpg')"; // Replace with the correct path to your image file
    document.getElementById('quiz-body').style.backgroundSize = 'cover';
    document.getElementById('quiz-body').style.backgroundPosition = 'center';
    
    // Hide landing page and show quiz page
    document.getElementById('landing-page').classList.add('hidden');
    document.getElementById('quiz-page').classList.remove('hidden');

    loadQuestion();
}

function loadQuestion() {
    const currentQuestion = questions[currentQuestionIndex];
    document.getElementById('question').textContent = currentQuestion.question;
    document.querySelectorAll('.option').forEach((btn, index) => {
        btn.textContent = currentQuestion.options[index];
        btn.classList.remove('correct', 'wrong', 'disabled'); // Remove any previous classes
        btn.style.pointerEvents = 'auto'; // Re-enable hover effect
    });
    selectedOptionIndex = null;
    document.getElementById('next-btn').style.display = 'none';
    document.getElementById('submit-btn').style.display = currentQuestionIndex === questions.length - 1 ? 'block' : 'none';
}

function selectOption(index) {
    if (selectedOptionIndex !== null) return; // Prevent multiple selections
    selectedOptionIndex = index;
    const currentQuestion = questions[currentQuestionIndex];
    const optionButtons = document.querySelectorAll('.option');

    if (index === currentQuestion.correct) {
        optionButtons[index].classList.add('correct');
        score++;
    } else {
        optionButtons[index].classList.add('wrong');
        optionButtons[currentQuestion.correct].classList.add('correct');
    }

    // Disable hover effect on all options after selection
    optionButtons.forEach(btn => {
        btn.classList.add('disabled');
        btn.style.pointerEvents = 'none';
    });

    if (currentQuestionIndex < questions.length - 1) {
        document.getElementById('next-btn').style.display = 'block';
    }
}

function nextQuestion() {
    currentQuestionIndex++;
    loadQuestion();
}

function submitQuiz() {
    document.getElementById('question-container').classList.add('hidden');
    document.getElementById('result-container').classList.remove('hidden');
    document.getElementById('result').textContent = `Your score: ${score}/${questions.length}`;
}

function finishQuiz() {
    // Redirect to the index.html page
    window.location.href = 'index.html';
}
