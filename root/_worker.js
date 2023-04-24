import main from "../src/main.js";

export default {
    async fetch(request, env) {
        return main.processRequest(request, env) || env.ASSETS.fetch(request);
    }
};
