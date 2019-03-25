import React from 'react';
import PropTypes from 'prop-types';

import Modal from 'react-bootstrap/Modal'
import Button from 'react-bootstrap/Button'
import WeatherDetail from "./WeatherDetail";

class ModalDialog extends React.Component {
    static propTypes = {
        show: PropTypes.bool,
        onModalClose: PropTypes.func,
        displayLoader: PropTypes.bool,
        weatherData: PropTypes.object,
        errorMessage: PropTypes.string
    }
    render() {
      const displayLoader = this.props.displayLoader;
      let modalBody;

      if (displayLoader) {
          modalBody = <div className="spinner-border" role="status">
                <span className="sr-only">Loading...</span>
          </div>;
      }
      else
      {
          modalBody = this.props.errorMessage ?
              <div>{this.props.errorMessage}</div> :
              <ul><WeatherDetail weatherData={this.props.weatherData} format={'single'} displayUnits={true} /></ul>
      }
      return (
        <Modal show={this.props.show} onHide={this.props.onModalClose}>
          <Modal.Header closeButton>
            <Modal.Title>{displayLoader ? 'Pobieram dane' : 'Dane o pogodzie'}</Modal.Title>
          </Modal.Header>
          <Modal.Body>{modalBody}</Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={this.props.onModalClose}>
              Close
            </Button>
          </Modal.Footer>
        </Modal>
      )
    }

}

export default ModalDialog;
