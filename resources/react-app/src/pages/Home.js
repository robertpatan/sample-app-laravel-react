import React, {Component} from 'react'
import Layout from "../components/Layout/Layout"
import Header from "../components/Header/Header";
import MovieCard from "../components/Movie/MovieCard";
import Api from "../api/api";


class Home extends Component {
  state = {
    isHomePath: window.location.pathname === '/',
  }

  componentDidMount = async () => {
    const response = await Api.getMovies();

    this.setState({...this.state, ...{movies: response.data}})
  }

  render() {
    let movieList = null;
    if(this.state.movies) {
      movieList = this.state.movies.map((item) => {
        return <MovieCard movie={item}/>
      });
    }

    return (
      <Layout>
        {movieList && movieList}
      </Layout>
    )

  }
}

export default Home;