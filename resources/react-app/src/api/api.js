import * as axios from "axios"
import queries from './graph-queries'

class Api {
  static apiHost = 'http://mg-app.local/api';

  /**
   * Return the list of movies
   * @returns {*}
   */
  static getMovies() {
    return axios({
      url: `${this.apiHost}/movies`,
      method: 'get',
    });
  }

  static getMovie(movieId) {
    return axios({
      url: `${this.apiHost}/movies/${movieId}` ,
      method: 'get',
    });
  }

  static getLayoutData() {
    return this.getData(queries.layout.query)
  }

  static getHomeData() {
    return this.getData(queries.home.query)
  }

  /**
   *
   * @param assetPath
   * @returns {string}
   */
  static asset(assetPath) {
    const url = new URL(`${this.apiHost}/cache-asset`);

    url.searchParams.set('path', btoa(assetPath));
    return url.href;
  }
}

export default Api;
