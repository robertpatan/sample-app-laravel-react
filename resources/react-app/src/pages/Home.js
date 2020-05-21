import React, {Component} from 'react'
import {Spinner} from "react-bootstrap";
import Layout from "../components/Layout/Layout"
import MovieCard from "../components/Movie/MovieCard";
import Api from "../api/api";


class Home extends Component {
  state = {
    movies: null,
    isHomePath: window.location.pathname === '/',
  };

  componentDidMount = async () => {
    const response = await Api.getMovies();

    this.setState({...this.state, ...{movies: response.data}})
  };

  render() {
    let movieList = null;
    if (this.state.movies) {
      movieList = this.state.movies.map((item, key) => {
        return (
          <div className="col-sm-12 col-md-4" style={{marginBottom: "20px"}} key={key}>
            <MovieCard movie={item} key={key}/>
          </div>
        )
      });
    }

    return (
      <Layout>
        <div className="jumbotron">
          <h1 className="display-4">MG Movie Collection</h1>
        </div>

        <div className="row" style={{"padding": "20px"}}>
          {!this.state.movies ?
            <div className="col-12 text-center">
              <Spinner animation="border" role="status" variant="primary"/>
            </div>
            :
            movieList
          }
        </div>


      </Layout>
    )

  }
}

export default Home;