const getUrl = (url) => {
    const urls = {
        invoice: "/api/invoices",
        stakeholder: "/api/stakeholders",
        product: "/api/products",
        category: "/api/categories",
        documentType: "/api/documentTypes",
        status: "/api/statuses",
        order: "/api/orders",
        role: "/api/roles",
    };
    return urls[url];
};

const getHeader = function () {
    const token = window.document.querySelector('meta[name="token"]').content;
    return {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + token
    }
}

function getClass(type) {
    const urlAll = `${getUrl(type)}/all`
    return axios.get(urlAll, {headers: getHeader()}).then((response) => response.data);
}

function getClassPaginated(type) {
    return axios.get(getUrl(type), {headers: getHeader()}).then((response) => response.data);
}

function getItem(type, id) {
    const urlItem = `${getUrl(type)}/${id}`;
    return axios.get(urlItem);
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
    getClassPaginated,
    getItem,
    createItem,
    updateItem,
    deleteItem,
    getHeader
};
