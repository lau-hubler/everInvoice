const getUrl = (url) => {
    const urls = {
        invoice: "/invoices",
        stakeholder: "/stakeholders",
        product: "/products",
        category: "/categories",
        documentType: "/documentTypes",
        status: "/statuses",
        order: "/orders",
    };
    return urls[url];
};

function getClass(type) {
    return axios.get(getUrl(type)).then((response) => response.data);
}

function getItem(type, id) {
    const urlItem = `${getUrl(type)}/${id}`;
    return axios.get(getUrl(urlItem)).then((response) => response.data);
}

function createItem(type, item) {
    return axios.post(getUrl(type), item).then((response) => response.data);
}

function updateItem(type, id, item) {
    const urlItem = `${getUrl(type)}/${id}`;
    return axios.put(urlItem, item).then((response) => response.data);
}

function deleteItem(type, item) {
    const urlItem = `${getUrl(type)}/${item.id}`;
    return axios.delete(urlItem);
}

export default {
    getClass,
    getItem,
    createItem,
    updateItem,
    deleteItem,
};
