const main = (() => {
    const processRequest = (request, env) => {
        const { protocol, pathname } = new URL(request.url);
        const requestType = request.headers.get("content-type");

        if (1 || request.method === "POST") {
            if ( pathname.match(/test\b/) ) {
                return responseJson({ success: 1 });
            }
        }

        return false;
    };

    return {
        processRequest: processRequest
    };
})();

const responseJson = (data) => {
    const json = JSON.stringify(data, null, 2);

    return new Response(json, {
        headers: {
            "content-type": "application/json;charset=UTF-8",
        }
    });
};

export default main;
