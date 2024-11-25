import React, { useState, useEffect } from 'react';

const CardProduct = ({ product, cartItems = [], handleAddToCart }) => {
    const [quantity, setQuantity] = useState(1);
    const [isOutOfStock, setIsOutOfStock] = useState(false);
    const [isAddedToCart, setIsAddedToCart] = useState(false);

    // Debugging outputs
    console.log("Product: ", product);
    console.log("Cart Items: ", cartItems);

    // Get the total quantity in the cart for this product
    const cartItem = cartItems.find(item => item.CartProductID === product.productid);
    const totalQuantityInCart = cartItem ? cartItem.CartQuantity : 0;

    // Effect to monitor stock and set out-of-stock state
    useEffect(() => {
        setIsOutOfStock(product.stock <= 0);
        setIsAddedToCart(totalQuantityInCart > 0);
    }, [product.stock, totalQuantityInCart]);

    const handleIncrease = () => {
        const newTotalQuantity = totalQuantityInCart + quantity;
        if (newTotalQuantity < product.stock) {
            setQuantity(prevQuantity => prevQuantity + 1);
        }
    };

    const handleDecrease = () => {
        if (quantity > 1) {
            setQuantity(prevQuantity => prevQuantity - 1);
        }
    };

    const handleAddToCartClick = async () => {
        const newTotalQuantity = totalQuantityInCart + quantity;
        if (newTotalQuantity > product.stock) {
            return;
        }
        await handleAddToCart(product.productid, quantity);
        setIsAddedToCart(true);
        setQuantity(1);
    };

    return (
        <div className="col-md-4 mb-4">
            <div className="card" style={{ width: '100%' }}>
                <img
                    src={`http://localhost/ecommerce/${product.productimg}`}
                    className="card-img-top"
                    alt={product.productname}
                    style={{ height: '300px', objectFit: 'cover' }}
                />
                <div className="card-body d-flex flex-column justify-content-between">
                    <h5 className="card-title">{product.productname}</h5>
                    <p className="card-text">{product.description}</p>
                    <p className="card-text">Price: ₹{product.price}</p>
                    <p className={`card-text ${isOutOfStock ? 'text-danger' : 'text-success'}`}>
                        {isOutOfStock ? 'Out of Stock' : `In Stock (${product.stock} left)`}
                    </p>

                    {!isOutOfStock && !isAddedToCart && (
                        <div className="input-group mb-3">
                            <button className="btn btn-outline-secondary" onClick={handleDecrease}>-</button>
                            <input type="text" className="form-control text-center" value={quantity} readOnly style={{ maxWidth: '50px' }} />
                            <button className="btn btn-outline-secondary" onClick={handleIncrease}>+</button>
                        </div>
                    )}

                    <button
                        className="btn btn-success mt-2 align-self-end"
                        onClick={handleAddToCartClick}
                        disabled={isOutOfStock || isAddedToCart}
                    >
                        {isOutOfStock
                            ? 'Out of Stock'
                            : isAddedToCart
                                ? 'Already Added'
                                : 'Add to Cart'}
                    </button>
                </div>
            </div>
        </div>
    );
};

export default CardProduct;
