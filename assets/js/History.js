require('../css/app.css');

import React from 'react';
import ReactDOM from 'react-dom';

import HistoryList from './Components/HistoryList';
import Statistic from './Components/Statistic';




class History extends React.Component {
  render() {
    return (
        <div className={"row"}>
            <div className={"col"}><h3>Lista ostatnich wyszukań</h3><HistoryList  /></div>
            <div className={"col"}><h3>Statystyki</h3><Statistic  /></div>
        </div>
    )
  }


}
ReactDOM.render(<History />, document.getElementById('root'));
