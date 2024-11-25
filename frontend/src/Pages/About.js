import React from 'react';

const About = () => {
  return (
    <div className="container mt-5">
      <h1 className="text-center mb-4">About Our Shop</h1>
      <div className="row">
        <div className="col-md-6">
          <h2>Who We Are</h2>
          <p>
            Welcome to our shop! We are passionate about providing the highest quality products 
            to our customers. Our journey began with the goal of offering unique, high-quality items that cater to our customers’ needs.
          </p>
          <p>
            Our team works tirelessly to bring the best products to our store, ensuring you always find something you love. 
            We pride ourselves on excellent customer service and a seamless shopping experience.
          </p>
        </div>
        <div className="col-md-6">
          <img 
            src="https://via.placeholder.com/500" 
            alt="Our Shop" 
            className="img-fluid rounded shadow"
          />
        </div>
      </div>

      <div className="row mt-5">
        <div className="col-md-12">
          <h2 className="text-center">Our Mission</h2>
          <p className="text-center">
            Our mission is to provide quality products at affordable prices. We believe in sourcing 
            the best items and delivering them with exceptional customer service.
          </p>
        </div>
      </div>

      <div className="row mt-5">
        <div className="col-md-12 text-center">
          <h2>Why Choose Us?</h2>
          <ul className="list-unstyled">
            <li>✔ High-quality products</li>
            <li>✔ Exceptional customer service</li>
            <li>✔ Fast and reliable shipping</li>
            <li>✔ Affordable prices</li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default About;
