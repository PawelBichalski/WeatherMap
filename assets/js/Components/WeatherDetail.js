import React from 'react';
import PropTypes from 'prop-types';
import shortid from 'shortid';

class WeatherDetail extends React.Component {
    static propTypes = {
        weatherData: PropTypes.object,
        format: PropTypes.oneOf(['single', 'table-row']),
        displayUnits: PropTypes.bool
    }

    createItem (title, value, unit='') {
        if (!this.props.displayUnits) {
            unit='';
        }
        if (this.props.format === 'single') {
            return (
                <li key={shortid.generate()}>{title}: {value} {unit}</li>
            )
        }
        else {
            return (
                <td key={shortid.generate()}>{value} {unit}</td>
            )
        }
    }

    render() {
        const wData = this.props.weatherData;
        if (!wData.city) {
            return null;
        }
        return ([
            this.createItem('Miasto', wData.city.name),
            this.createItem('Współrzędne', `${wData.coordinates.latitude}, ${wData.coordinates.longitude}`),
            this.createItem('Temperatura', wData.temperature, '°C'),
            this.createItem('Zachmurzenie', wData.clouds, '%'),
            this.createItem('Wiatr', wData.wind, 'm/s'),
            this.createItem('Opis', wData.description),
            this.createItem('Data', wData.date)
        ]);
    }
}

export default WeatherDetail;
