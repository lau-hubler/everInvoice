const getUrl = (url) => {
    const urls = {
        invoice: "/api/invoices",
        stakeholder: "/api/stakeholders",
        product: "/api/products",
        category: "/api/categories",
        documentType: "/api/documentTypes",
        status: "/api/statuses",
        order: "/api/orders",
    };
    return urls[url];
};

const getHeader = function () {
    const token = "nYCNMztzOx3nyNpYUKmXW5z1cAyQIXxQW0MDqHlR0ocKCfvmsd2JAsEU0UMRPZfl5sjt3vT8GyVbNby8"
    return {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + token
    }
}

function getClass(type) {
    return axios.get(getUrl(type), {headers: getHeader()}).then((response) => response.data);
}

function getItem(type, id) {
    const urlItem = `${getUrl(type)}/${id}`;
    return axios.get(getUrl(urlItem)).then((response) => response.data);
}

function createItem(type, item) {
    return axios.post(getUrl(type), item, {headers: getHeader()}).then((response) => response.data);
}

function updateItem(type, id, item) {
    const urlItem = `${getUrl(type)}/${id}`;
    return axios.put(urlItem, item, {headers: getHeader()}).then((response) => response.data);
}

function deleteItem(type, item) {
    const urlItem = `${getUrl(type)}/${item.id}`;
    return axios.delete(urlItem, {headers: getHeader()});
}

export default {
    getClass,
    getItem,
    createItem,
    updateItem,
    deleteItem,
};
