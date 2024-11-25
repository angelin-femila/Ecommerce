import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

function CardCategory() {
    const [categories, setCategories] = useState([]);
    const [loading, setLoading] = useState(true);

    // Fetch data using useEffect when the component mounts
    useEffect(() => {
        axios.post('http://localhost/ecommerce/api/addcategory')
            .then(response => {
                setCategories(response.data); // Store data in state
                setLoading(false); // Set loading to false once data is fetched
            })
            .catch(error => {
                console.error('There was an error fetching the categories!', error);
                setLoading(false);
            });
    }, []);

    if (loading) {
        return <div>Loading...</div>;
    }

    return (
        <div className="container my-4">
            <h2 className="text-center mb-4">
                <Link to="" className="text-dark" style={{ textDecoration: 'none' }}>
                    Categories
                </Link>
            </h2>

            <div className="row">
                {categories.map((category) => (
                    <div className="col-md-4 mb-4" key={category.CategoryID}>
                        <div className="card" style={{ width: '100%' }}>
                            {/* Fix the image path */}
                            <img
                                src={`http://localhost/ecommerce/${category.CategoryImg}`}
                                className="card-img-top"
                                alt={category.CategoryName}
                                style={{ height: '300px', objectFit: 'cover' }} // Adjust image size
                            />
                            <div className="card-body  d-flex flex-column justify-content-between">
                                <h5 className="card-title">{category.CategoryName}</h5>
                                <Link
                                    to={`/category/${category.CategoryID}`} // Pass CategoryID in URL
                                    state={{ category }} // Pass the whole category object if needed
                                    className="btn btn-info mt-2 align-self-end"
                                >
                                    View
                                </Link>

                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
}

export default CardCategory;
