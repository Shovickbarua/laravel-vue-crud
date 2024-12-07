import axios from 'axios';

const CustomerApi = () => {};

CustomerApi.index = async () => {
    const url = '/api/customer/';
    const res = await axios.get(url)
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            return error;
        });
    return res;
};

CustomerApi.save = async (data) => {
    let url = '/api/customer/';
    if (data.id) url = '/api/customer/' + data.id + '?_method=PUT';
    const res = await axios.post(url, data)
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            return error;
        });
    return res;
};

CustomerApi.show = async (id) => {
    const url = '/api/customer/' + id;
    const res = await axios.get(url)
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            return error;
        });
    return res;
};

CustomerApi.delete = async (id) => {
    const url = '/api/customer/' + id;
    const res = await axios.delete(url)
        .then((response) => {
            return response.data;
        })
        .catch((error) => {
            return error;
        })
    return res;
};

export default CustomerApi;