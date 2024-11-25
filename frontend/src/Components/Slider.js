import 'bootstrap/dist/css/bootstrap.min.css'; 
import 'bootstrap/dist/js/bootstrap.bundle.min'; 
import { useEffect, useState } from 'react';
import axios from 'axios';

function Slider() {
  const [banners, setBanners] = useState([]);

  useEffect(() => {
    // Fetch banners from the API
    axios.post('http://localhost/ecommerce/api/getbanners')
      .then((response) => {
        setBanners(response.data);  // Axios automatically parses JSON
      })
      .catch((error) => {
        console.error('Error fetching banners:', error);
      });
  }, []);

  return (
    <div id="carouselExampleFade" className="carousel slide carousel-fade">
      <div className="carousel-inner">
        {banners.length > 0 ? (
          banners.map((banner, index) => (
            <div
              key={banner.BannerID}
              className={`carousel-item ${index === 0 ? 'active' : ''}`}>
              <img
                src={banner.BannerImg ? `http://localhost/ecommerce/${banner.BannerImg}` : '/images/default-banner.png'}
                className="d-block w-100"
                alt={`Banner ${index + 1}`}
                style={{ height: '425px' }}
              />
            </div>
          ))
        ) : (
          <div className="carousel-item active">
            <img src="/images/default-banner.png" className="d-block w-100" alt="Default banner" style={{ height: '425px' }} />
          </div>
        )}
      </div>
      <button className="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span className="carousel-control-prev-icon" aria-hidden="true"></span>
        <span className="visually-hidden">Previous</span>
      </button>
      <button className="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span className="carousel-control-next-icon" aria-hidden="true"></span>
        <span className="visually-hidden">Next</span>
      </button>
    </div>
  );
}

export default Slider;
