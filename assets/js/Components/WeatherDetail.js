import React from 'react';
import PropTypes from 'prop-types';

class WeatherDetail extends React.Component {
    static propTypes = {
        weatherData: PropTypes.object
    }

    render() {
        const wData = this.props.weatherData;
        if (!wData.city) {
            return null;
        }
        return(
        <div>
            <ul>
                <li>Miasto: {wData.city.name}</li>
                <li>Współrzędne: {wData.latitude}, {wData.longitude}</li>
                <li>Temperatura: {wData.temperature} C</li>
                <li>Zachmurzenie: {wData.clouds} %</li>
                <li>Wiatr: {wData.wind} m/s</li>
                <li>Opis: {wData.description}</li>
                <li>Data: {wData.date}</li>
            </ul>
        </div>
    )}
}

export default WeatherDetail;
