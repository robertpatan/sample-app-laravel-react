import React, {Component} from 'react'
import {Link} from "react-router-dom";
import Api from "../../api/api";

class MovieCard extends Component {

  render() {
    const movie = this.props.movie;
    const thumbnail = movie.key_art_images.shift();

    return (
      <div className="card">
        <div className="col-12 text-center">
          <img className="card-img-top" src={Api.asset(thumbnail.cache_storage_path)}
               style={{
                 height: thumbnail.height ? thumbnail.height : 100,
                 width: thumbnail.width ? thumbnail.width : 100,
               }}
               alt={movie.headline}/>
        </div>

        <div className="card-body">
          <h5 className="card-title">{movie.headline}</h5>
          <p className="card-text" dangerouslySetInnerHTML={{ __html: movie.body }}/>
          <Link to={`/movies/${movie.id}`} className="btn btn-primary">See Details</Link>
        </div>
      </div>
    )

  }
}

export default MovieCard;