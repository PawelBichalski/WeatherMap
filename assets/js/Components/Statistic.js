import React from 'react';
import ReactDOM from 'react-dom';

import Api from '../Utils/Api';

class Statistic extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
        statData: null,
        errorMessage: ''
    };
  }

  componentDidMount() {
     Api.get('stat')
     .then(res => {
        this.setState({statData: res.data, errorMessage: ''});
     })
     .catch(error => {
         this.setState({statData: null, errorMessage: error.message});
     });
  }
  render() {
    if (this.state.errorMessage) {
       return <div>{this.state.errorMessage}</div>
    }
    if (!this.state.statData || this.state.statData.dataCount < 1) {
        return <div>Brak danych</div>;
    }
    const statData = this.state.statData;
    const roundAvgTemp = Math.round(100*statData.temperature.avg)/100;

    return(
        <div>
            <ul>
                <li>Temperatura
                    <ul>
                        <li>minimalna: {statData.temperature.min}</li>
                        <li>maksymalna: {statData.temperature.max}</li>
                        <li>średnia: {roundAvgTemp}</li>
                    </ul>
                </li>
                <li>Najczęściej wyszukiwane miasto: {statData.mostPopularCity.city.name} ({statData.mostPopularCity.numData})</li>
                <li>Ilość łącznych wyszukiwań: {statData.dataCount}</li>
            </ul>
        </div>
    )}
}

export default Statistic;
