import React, { useState, useEffect } from 'react';
import { ToastContainer, toast } from 'react-toastify';
import axios from 'axios';

const Cart = () => {
    const [cartItems, setCartItems] = useState([]);
    const userId = localStorage.getItem('userId'); // Ensure userId is fetched here

    const fetchCartItems = async () => {
        if (!userId) {
            toast.error('User ID is required');
            return;
        }

        try {
            const response = await axios.post('http://localhost/ecommerce/api/getcartitems', {
                CartUserID: userId,
            });
            console.log('Cart items:', response.data);
            setCartItems(response.data);
        } catch (error) {
            console.error('Error fetching cart items:', error.response ? error.response.data : error.message);
            toast.error('Failed to fetch cart items');
        }
    };
   
    const placeOrderHandler = async () => {
        try {
            if (cartItems.length === 0) {
                toast.error('No items in the cart to place an order');
                return;
            }
    
            // Use the actual cart items fetched from the API
            const totalAmount = cartItems.reduce((sum, item) => sum + (item.price * item.CartQuantity), 0);
    
            // Ensure that you are sending each product in the cart
            const orderPromises = cartItems.map(item => {
                // Log item to ensure it has CartID
                console.log('Processing item:', item);
                const productId = item.CartID; // Use CartID instead of productId
    
                if (!productId) {
                    throw new Error('Product ID is missing for one of the items');
                }
    
                return axios.post('http://localhost/ecommerce/api/placeorder', {
                    UserID: userId, // Use the actual userId from localStorage
                    ProductID: productId, // Using CartID as ProductID
                    TotalAmount: (item.price * item.CartQuantity), // Total for this item
                });
            });
    
            // Await all order placements
            await Promise.all(orderPromises);
    
            // Success toast message
            toast.success('Order placed successfully');
    
            // Clear cart items after placing the order
            setCartItems([]);
    
        } catch (error) {
            console.error('Error placing order:', error.response?.data || error.message);
            toast.error('Failed to place order');
        }
    };
    

    useEffect(() => {
        fetchCartItems();
    }, [userId]); // Add userId as a dependency

    return (
        <div className="container mt-5">
            <h2 className="text-center">Your Cart</h2>
            <div className="row">
                {cartItems.length === 0 ? (
                    <div className="col-12 text-center">Your cart is empty.</div>
                ) : (
                    cartItems.map((item) => (
                        <div key={item.CartID} className="col-md-4">
                            <div className="card mb-4 shadow-sm">
                                <img
                                    src={`http://localhost/ecommerce/${item.productimg}`} 
                                    alt={item.productname || 'Unknown Product'}
                                    className="card-img-top"
                                    style={{ height: '200px', objectFit: 'cover' }}
                                />
                                <div className="card-body">
                                    <h5 className="card-title">{item.productname || 'Unknown Product'}</h5>
                                    <p className="card-text">Price: ₹{item.price}</p>
                                    <p className="card-text">Quantity: {item.CartQuantity}</p>
                                    <p className="card-text">Total: ₹{(item.price * item.CartQuantity).toFixed(2)}</p>
                                </div>
                            </div>
                        </div>
                    ))
                )}
            </div>
            {cartItems.length > 0 && (
                <button onClick={placeOrderHandler} className="btn btn-primary mt-3">
                    Place Order
                </button>
            )}
            <ToastContainer position="top-right" autoClose={5000} />
        </div>
    );
};

export default Cart;
