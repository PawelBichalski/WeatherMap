
require('../css/app.css');


import React from 'react';
import ReactDOM from 'react-dom';

import Map from './Components/Map';
import ModalDialog from './Components/ModalDialog';

import Api from './Utils/Api';


class WeatherMap extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isModalOpen: false,
      isDataFetched: false,
      weatherData: {},
      errorMessage: ''
    };
  }

  mapClickHandler = event => {
      this.setState({
        isModalOpen : true,
        isDataFetched: false,
        weatherData: {},
        errorMessage: ''
      });
      Api.get(`openweather/${event.latLng.lat()}/${event.latLng.lng()}`)
      .then(res => {
          this.setState({weatherData: res.data, isDataFetched: true});
      })
      .catch(error => {
          this.setState({weatherData: {}, isDataFetched: true, errorMessage: error.message});
      });
  }

  closeModal = () => {
    this.setState({
     isModalOpen : false
    });
  }

  render() {
    return (
        <div>
          <Map
              onMapClick={this.mapClickHandler}
              googleMapURL={"https://maps.googleapis.com/maps/api/js?key=GOOGLE_API_KEY&v=3.exp&libraries=geometry"}
          />
          <ModalDialog
              show={this.state.isModalOpen}
              onModalClose={this.closeModal}
              displayLoader={!this.state.isDataFetched}
              weatherData={this.state.weatherData}
              errorMessage={this.state.errorMessage}
          />
        </div>
    )
  }

}
ReactDOM.render(<WeatherMap />, document.getElementById('root'));
