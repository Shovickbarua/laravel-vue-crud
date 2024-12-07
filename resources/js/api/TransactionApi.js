import axios from 'axios';

const TransactionApi = () => {};

TransactionApi.index = async () => {
    const url = '/api/transaction/';
    const res = await axios.get(url)
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            return error;
        });
    return res;
};

TransactionApi.save = async (data) => {
    let url = '/api/transaction/';
    const res = await axios.post(url, data)
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            return error;
        });
    return res;
};

export default TransactionApi;