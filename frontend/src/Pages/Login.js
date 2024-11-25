import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [message, setMessage] = useState('');
  const navigate = useNavigate();

  const handleLogin = (e) => {
    e.preventDefault();
  
    const existingUsers = JSON.parse(localStorage.getItem('users')) || [];
  
    // Find user with matching email
    const user = existingUsers.find(user => user.email === email);
  
    if (user) {
      // Check if the hashed password matches
      if (user.password === btoa(password)) {
        // Successful login
        localStorage.setItem('userID', user.userId); // Store the user ID separately
        setMessage('Login Successful!');
  
        // Redirect to homepage after 1 second
        setTimeout(() => {
          navigate('/home'); // Navigate to your homepage or dashboard
        }, 1000);
      } else {
        setMessage('Invalid email or password.');
        console.log('Incorrect password'); // Debugging message
      }
    } else {
      setMessage('Invalid email or password.');
      console.log('Email not found'); // Debugging message
    }
  };
  
  

  return (
    <div className="d-flex flex-column justify-content-center align-items-center min-vh-100">
      <h4 className="mb-4">Login</h4>

      <div className="card shadow" style={{ width: '100%', maxWidth: '500px' }}>
        <div className="card-body">
          {message && <div className="alert alert-info w-100 text-center">{message}</div>}
          <form onSubmit={handleLogin} className="w-100">
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
              <button type="submit" className="btn btn-primary w-50 btn-lg">Login</button>
            </div>
          </form>
          <div className="mt-3 text-center">
            <p>Don't have an account? <a href="/register">Register here</a></p>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Login;
