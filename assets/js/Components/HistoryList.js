import React from 'react';
import ReactDOM from 'react-dom';
import PropTypes from 'prop-types';

import ReactPaginate from 'react-paginate';

import Api from '../Utils/Api';

class HistoryList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            historyList: [],
            pageCount: 0,
            errorMessage: ''
        }
    };
    componentDidMount() {
        this.fetchHistory();
    }

    fetchHistory (page=1) {
        this.setState({
            historyList: [],
            errorMessage: ''
        });
        Api.get(`history/${page}`)
        .then(res => {
          this.setState({historyList: res.data.data, pageCount: res.data.numPages});
        })
        .catch(error => {
          this.setState({errorMessage: error.message});
        });
    }
    handlePageClick = data => {
        this.fetchHistory(data.selected+1);
    };

    renderTableRow (historyItem) {
        return (
            <tr key={historyItem.id}>
               <td>{historyItem.city.name}</td>
               <td>{historyItem.latitude}, {historyItem.longitude}</td>
               <td>{historyItem.temperature}</td>
               <td>{historyItem.clouds}</td>
               <td>{historyItem.wind}</td>
               <td>{historyItem.description}</td>
               <td>{historyItem.date}</td>
            </tr>
        )
    }

    render() {
        return(
        <div>
            <table className="table table-bordered table-hover table-sm">
                <thead><tr>
                    <th scope="col">Miasto</th>
                    <th scope="col">Współrzędne</th>
                    <th scope="col">Temperatura [C]</th>
                    <th scope="col">Zachmurzenie [%]</th>
                    <th scope="col">Wiatr [m/s]</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Data</th>
                </tr></thead>
                <tbody>
                {this.state.errorMessage ?
                    <tr><td colSpan={7}>{this.state.errorMessage}</td></tr> :
                    this.state.historyList.map(this.renderTableRow)
                }
                </tbody>
            </table>
            <nav aria-label="Page navigation">
            <ReactPaginate
                pageCount={this.state.pageCount}
                marginPagesDisplayed={2}
                pageRangeDisplayed={5}
                onPageChange={this.handlePageClick}
                containerClassName={'pagination'}
                pageClassName={'page-item'}
                previousClassName={'page-item'}
                nextClassName={'page-item'}
                pageLinkClassName={'page-link'}
                previousLinkClassName={'page-link'}
                nextLinkClassName={'page-link'}
                activeClassName={'active'}
            />
            </nav>
        </div>
    )}
}

export default HistoryList;
