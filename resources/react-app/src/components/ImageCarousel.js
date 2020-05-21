import React, {Component} from 'react'
import Carousel from "react-bootstrap/Carousel";
import Api from "../api/api";
import {Image} from "react-bootstrap";

class ImageCarousel extends Component {

  render() {
    let images = null;
    if (this.props.images) {
      images = this.props.images.map(image => {
        return (
          <Carousel.Item key={image.id}>
            <Image className="img-fluid"
              src={Api.asset(image.cache_storage_path)}
             alt=""/>
          </Carousel.Item>
        );
      });
    }


    return (
      <Carousel style={{backgroundColor: '#777777'}} className="text-center">
        {images && images}
      </Carousel>
    )

  }
}

export default ImageCarousel;