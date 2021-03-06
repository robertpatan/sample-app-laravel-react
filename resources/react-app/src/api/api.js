import * as axios from "axios"

class Api {
  static apiHost = 'http://127.0.0.1/api';

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
