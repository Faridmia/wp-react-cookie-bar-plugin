import React, { Component } from "react";

class CookiePlugin extends Component {
  constructor(props) {
    super(props);
    this.state = {
      visible: true,
    };
    this.SmartcbAcceptCookies = this.SmartcbAcceptCookies.bind(this);
    this.SmartcbDeclineCookies = this.SmartcbDeclineCookies.bind(this);

  }

  SmartcbAcceptCookies() {
    Cookies.set("SmartcbCookieSetCookie", true, { expires: 7 });
    this.setState({ visible: false });

    console.log( appCookie.cookie_assets_url );
  }

  SmartcbDeclineCookies() {
    Cookies.set("SmartcbDeclineCookie", false);
    this.setState({ visible: false });
  }

 

  render() {
    return this.state.visible ? (
      <div className="CookieBanner container fixed-bottom alert alert-light border alert-dismissible fade show" role="alert">
        <div className="row justify-content-between align-items-center">
          <div className="col-1 h-full d-flex align-items-center justify-content-center cookie-img-right">
            <img src={`${appCookie.cookie_assets_url}/assets/cookie.png`} width="80px" />
          </div>
          <div className="col-8">
            <p className="m-0 fw-bolder">Are you okay with Cookies?</p>
            <p className="lh-base fs-6 m-0">
              Cookies let us give you a better experience and improve our products.<br />We won't turn them on until
              you accept.
            </p>
          </div>
          <div className="col-2">
            <div className="row cookie-right-button-part">
              <button id="accept" onClick={this.SmartcbAcceptCookies} type="button" className="btn btn-info text-white mb-2 cookie-btn-one">
                Accept
              </button>
              <button id="decline" onClick={this.SmartcbDeclineCookies} type="button" className="btn btn-outline-info cookie-btn-two">
                Decline
              </button>
            </div>
          </div>
        </div>
      </div>
    ) : null;
  }
}

export default CookiePlugin;
