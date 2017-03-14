function parseQueryParams(paramsPath) {
    var aux = {};

    if (paramsPath) {
        var params = paramsPath.split('&');
        for (var el in params) {
            if (params[el].split('=')[0] != 'page') {
                aux[params[el].split('=')[0]] = params[el].split('=')[1];
            }
        }
    }

    return aux;
}

function buildQueryParams(params) {
    var page = 1;
    var query = '?page=' + page;

    for (var paramKey in params) {
        if (paramKey !== 'page' && params[paramKey] !== null) {
            query += '&' + paramKey + '=' + params[paramKey];
        }
    }
    return query;
}