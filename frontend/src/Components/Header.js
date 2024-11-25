import React, { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import { FaShoppingCart } from 'react-icons/fa';
import axios from 'axios';

function Header() {
    const [cartCount, setCartCount] = useState(0);
    const navigate = useNavigate();

    useEffect(() => {
        fetchCartCount(); // Fetch initial cart count
    }, []);

    const fetchCartCount = async () => {
        const userId = localStorage.getItem('userId');
        if (userId) {
            try {
                const response = await axios.post('http://localhost/ecommerce/api/getcartitems', {
                    CartUserID: userId, // Correctly send CartUserID
                });
                console.log('API Response:', response.data); // Log the response
                setCartCount(response.data.length); // Set cart count
            } catch (error) {
                console.error('Error fetching cart count:', error.response?.data || error.message);
            }
        }
    };

    const handleCartClick = () => {
        navigate('/cart');
    };

    return (
        <div>
            <nav className="navbar navbar-expand-lg bg-info-subtle mb-4">
                <div className="container-fluid">
                    <Link className="navbar-brand" to="/">Ministore</Link>
                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                            <li className="nav-item">
                                <Link className="nav-link active" to="/home">Home</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/about">About</Link>
                            </li>
                            <li className="nav-item">
                                <Link className="nav-link" to="/contact">Contact</Link>
                            </li>
                        </ul>
                        <Link to="/cart" onClick={handleCartClick} className="nav-link position-relative me-3">
                            <FaShoppingCart size={24} />
                            {cartCount > 0 && (
                                <span className="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                    {cartCount}
                                </span>
                            )}
                        </Link>
                        <form className="d-flex align-items-center" role="search">
                            <input className="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                            <button className="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    );
}

export default Header;
