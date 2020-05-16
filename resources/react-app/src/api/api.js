import * as axios from "axios"
import queries from './graph-queries'

class Api {
  static apiHost = 'http://mg-app.local/api';
  static assetUrl = 'http://localhost:1337';

  static getMovies() {
    return axios({
      url: `${this.apiHost}/movies`,
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
   * @param url
   * @returns {string}
   */
  static asset(url) {
    return this.assetUrl + url;
  }
}

export default Api;
