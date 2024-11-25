import './App.css';
import React from 'react';
import { BrowserRouter as Router, Route, Routes, useLocation } from 'react-router-dom';
import Home from './Pages/Home';
import Login from './Pages/Login';
import CategoryDetails from './Pages/CategoryDetails';
import Register from './Pages/Register';
import Cart from './Pages/Cart';
import Header from './Components/Header';
import Footer from './Components/Footer';
import About from './Pages/About';
import Contact from './Pages/Contact';

// A separate component to handle layout and conditional rendering
function Layout() {
  const location = useLocation();
  
  // Define paths where Header and Footer should not be displayed
  const noHeaderFooterPaths = ["/", "/register"];

  return (
    <>
      {/* Only render Header if the current path is not in the noHeaderFooterPaths */}
      {!noHeaderFooterPaths.includes(location.pathname) && <Header />}
      
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/home" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/category/:categoryID" element={<CategoryDetails />} />
        <Route path="/cart" element={<Cart />} />
        {/* Add more routes here */}
      </Routes>
      
      {/* Only render Footer if the current path is not in the noHeaderFooterPaths */}
      {!noHeaderFooterPaths.includes(location.pathname) && <Footer />}
    </>
  );
}

function App() {
  return (
    <Router>
      <Layout />
    </Router>
  );
}

export default App;
