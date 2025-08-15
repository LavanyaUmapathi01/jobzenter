// JS code for admin-login.js
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
  
    const email = document.getElementById('email').value.toLowerCase(); // Convert email to lowercase for validation
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
        title: 'Hey, you successfully logged in!',
        text: 'Welcome to JZ Team!',
        iconColor: '#ffc107',
        confirmButtonColor: '#ffc107',
        timer: 6000,
        timerProgressBar: true
      }).then(() => {
        window.location.href = 'https://docs.google.com/spreadsheets/d/1OhbqjpJil5jtt1vHsB-Hm2649bm0OtoqRoxK7W8shR4/edit?usp=sharing';
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
  