import React, {Component} from 'react'
import Layout from "../components/Layout/Layout"
import Api from "../api/api";
import {Figure, Spinner} from "react-bootstrap";
import ImageCarousel from "../components/ImageCarousel";
import MediaModal from "../components/MediaModal";
import {Link} from "react-router-dom";


class MovieView extends Component {
  state = {
    movie: null,
    isActive: window.location.pathname === '/movies',
    showModal: false,
    modalContentType: null,
    modalUrl: null
  };


  componentDidMount = async () => {
    const response = await Api.getMovie(this.props.match.params.id);

    this.setState({...this.state, ...{movie: response.data}})
  };

  render() {
    const movie = this.state.movie;

    let description,
      directors,
      cast,
      imageSection,
      videos,
      cardSection,
      genres = null;

    if (this.state.movie) {
      let images = movie.key_art_images.map(image => {
        return (
          <Figure.Image
            width={image.width ? image.width : 100}
            height={image.height ? image.height : 100}
            src={Api.asset(image.cache_storage_path)}
            style={{padding: '5px'}}
          />
        );
      });

      imageSection = (
        <ImageCarousel images={movie.card_images}/>
      );

      description = (
        <Figure>
          {images && images}
          <Figure.Caption dangerouslySetInnerHTML={{__html: movie.body}}/>
        </Figure>
      );

      directors = movie.directors.map((item, key) => {
        return (
          <span>{item.name}{key === movie.directors.length - 1 ? '' : ', '}</span>
        );
      });

      cast = movie.cast.map((item, key) => {
        return (
          <span>{item.name}{key === movie.cast.length - 1 ? '' : ', '}</span>
        );
      });

      genres = movie.genres.map((item, key) => {
        return (
          <span>{item.name}{key === movie.genres.length - 1 ? '' : ', '}</span>
        );
      });

      videos = movie.videos.map((item) => {
        return (
          <video width="320" height="240" controls>
            <source src={item.cache_storage_path} type="video/mp4"/>
            Your browser does not support the video tag.
          </video>
        );
      })
    }

    return (
      <Layout>
        <div className="jumbotron">
          <h1 className="display-4"> {this.state.movie && movie.headline}</h1>
        </div>
        <div className="row" style={{"padding": "20px"}}>
          {!this.state.movie ?
            <div className="col-12 text-center">
              <Spinner animation="border" role="status" variant="primary"/>
            </div>
            : null
          }

          <div className="col-12">
            {this.state.movie && description}

            <p>Class: {(this.state.movie && movie.class) ? movie.class : 'N/A'}</p>
            <p>Duration: {(this.state.movie && movie.duration) ? Math.floor(movie.duration / 60) + ' minutes' : 'N/A'}</p>

            <p>Directors: {this.state.movie && directors}</p>
            <p>Cast: {this.state.movie && cast}</p>
            <p>Genres: {this.state.movie && genres}</p>
            <p>Year: {(this.state.movie && movie.year) ? movie.year : 'N/A'}</p>
            <p>Rating: {(this.state.movie && movie.rating) ? movie.rating : 'N/A'}</p>

            {
              (this.state.movie && movie.quote) ?
                <p>Quote: {movie.quote}</p>
                : null
            }

            {
              (this.state.movie && movie.review_author) ?
                <p>Review Author: {movie.review_author.name}</p>
                : null
            }

            {
              (this.state.movie && movie.sky_go_id) ?
                <p>Sky Go Id: {movie.sky_go_id}</p>
                : null
            }
            {
              (this.state.movie && movie.sky_go_url) ?
                <p>Sky Go Url:<Link to={movie.sky_go_url}/></p>
                : null
            }

            {
              (this.state.movie && movie.synopsis) ?
                <p>Synopsis: {movie.synopsis}</p>
                : null
            }
          </div>
        </div>
        <div className="col-12">
          <h4>Photos</h4>
          {this.state.movie && imageSection}
        </div>

        <div className="col-12">
          <h4>Videos</h4>
          {this.state.movie && videos}
        </div>

        <MediaModal show={this.state.showModal} type={this.state.modalContentType} url={this.state.modalUrl}/>

      </Layout>
    )

  }
}

export default MovieView;