import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import CardProduct from '../Components/CardProduct';

const CategoryDetails = () => {
    const { categoryID } = useParams();
    const [products, setProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetchProducts();
    }, [categoryID]);

    const fetchProducts = async () => {
        try {
            const response = await axios.post('http://localhost/ecommerce/api/getproducts', {
                CategoryID: categoryID
            });
            setProducts(response.data);
            setError(null);
        } catch (error) {
            setError('Error fetching products');
        } finally {
            setLoading(false);
        }
    };

    const handleAddToCart = async (productId, quantity) => {
        const userId = localStorage.getItem('userId');

        if (!userId) {
            toast.error('Please log in to add items to the cart.');
            return;
        }

        try {
            const response = await axios.post('http://localhost/ecommerce/api/addtocarts', {
                CartUserID: userId,
                CartProductID: productId,
                CartQuantity: quantity
            });

            if (response.status === 200) {
                toast.success(response.data.message || 'Item added to cart successfully!');
            } else {
                throw new Error('Unexpected response status');
            }
        } catch (error) {
            console.error('Error adding to cart:', error);
            const errorMessage = error.response
                ? error.response.data.message || 'Invalid request. Please check your inputs.'
                : 'Something went wrong. Please try again.';
            toast.error(errorMessage);
        }
    };

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (
        <>
            <div className="container">
                <h2 className='text-center mt-5'>Products</h2>
                <div className="row mt-5">
                    {products.map((product) => (
                        <CardProduct
                            key={product.productid}
                            product={product}
                            handleAddToCart={handleAddToCart} // Removed cartItems prop
                        />
                    ))}
                </div>
            </div>
            <ToastContainer position="top-right" autoClose={5000} />
        </>
    );
};

export default CategoryDetails;
