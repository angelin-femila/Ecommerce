import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

function Register() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [message, setMessage] = useState('');
  const navigate = useNavigate();

  const handleRegister = (e) => {
    e.preventDefault();
  
    const existingUsers = JSON.parse(localStorage.getItem('users')) || [];
  
    // Check if the email is already taken
    const userExists = existingUsers.some(user => user.email === email);
    if (userExists) {
      setMessage('Email already taken. Please choose another.');
    } else {
      // Generate a simple unique userId
      const userId = Date.now(); // Example of generating a userId
      const hashedPassword = btoa(password); // Encode the password
      const newUser = { email, userId, password: hashedPassword };
  
      // Store the new user in localStorage
      existingUsers.push(newUser);
      localStorage.setItem('users', JSON.stringify(existingUsers)); // Store all users
      
      // Store the user ID and email
      localStorage.setItem('userId', userId); // Store the user ID consistently
      localStorage.setItem('email', email); // Store the email separately
  
      setMessage('Registration Successful! Please log in.');
  
      // Clear the form fields
      setEmail('');
      setPassword('');
  
      // Redirect to login page after 1 second
      setTimeout(() => {
        navigate('/'); // Ensure this points to your login route
      }, 1000);
    }
  };
  
  return (
    <div className="d-flex flex-column justify-content-center align-items-center min-vh-100">
      <h4 className="mb-4">Register</h4>

      <div className="card shadow" style={{ width: '100%', maxWidth: '500px' }}>
        <div className="card-body">
          {message && <div className="alert alert-info w-100 text-center">{message}</div>}
          <form onSubmit={handleRegister} className="w-100">
            <div className="form-group mb-3">
              <label htmlFor="email">Email</label>
              <input
                type="email"
                className="form-control form-control-lg"
                id="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
              />
            </div>
            <div className="form-group mb-4">
              <label htmlFor="password">Password</label>
              <input
                type={showPassword ? 'text' : 'password'}
                className="form-control form-control-lg"
                id="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
              />
              <label className="form-check mt-2 d-flex align-items-center">
                <input
                  type="checkbox"
                  className="form-check-input me-2"
                  onChange={() => setShowPassword(!showPassword)}
                />
                Show Password
              </label>
            </div>
            <div className="d-flex justify-content-center">
              <button type="submit" className="btn btn-primary w-50 btn-lg">Register</button>
            </div>
          </form>
          <div className="mt-3 text-center">
            <p>Already have an account? <a href="/">Login here</a></p>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Register;
