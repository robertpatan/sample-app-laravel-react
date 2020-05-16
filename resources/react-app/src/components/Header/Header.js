import React from "react";
import {Link} from "react-router-dom";

const Header = (props) => {
  return (
    <nav className="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
      <div className="container">
        <Link to="/" className="navbar-brand js-scroll-trigger">MG MOVIES</Link>
        <div className="collapse navbar-collapse" id="navbarResponsive">
          <ul className="navbar-nav ml-auto">
            <li className="nav-item mx-0 mx-lg-1">
              <Link to="/" className="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger">MOVIES</Link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Header;
