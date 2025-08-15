<!-- Create a new JS file named jobsupport.js -->
// JS code for jobsupport.js
document.getElementById('jobSupportForm').addEventListener('submit', function(event) {
  event.preventDefault();

  const email = document.getElementById('email').value.toLowerCase(); // Email case insensitive
  const password = document.getElementById('password').value;

  const validUsers = [
    { email: 'jobzenter24@gmail.com', password: 'Jobzenter@123' },
    { email: 'user1@example.com', password: 'password1' },
    { email: 'user2@example.com', password: 'password2' },
    // Add more users here
  ];

  const user = validUsers.find(user => user.email === email && user.password === password);

  if (user) {
    Swal.fire({
      icon: 'success',
      title: 'Successfully Logged In!',
      text: 'Welcome to Job Support Section!',
      iconColor: '#ffc107',
      confirmButtonColor: '#ffc107',
      timer: 3000,
      timerProgressBar: true
    }).then(() => {
      window.location.href = 'https://docs.google.com/spreadsheets/d/1bYy38mFs-HlBequlNzU2SjjITOuU-yCRZp6S9Oo_Yc0/edit?usp=sharing';
    });
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Invalid Credentials',
      text: 'Please try again.',
      confirmButtonColor: '#ff2120'
    });
  }
});
