memex.dep.register("api.linker", async () => {

    /**
     * Responsible for making calls to the Memex API's Linker section.
     *
     * Handles all API calls to `/v1/linker/*`
     *
     * @class MemexApiLinker
     */
    return class MemexApiLinker {

        /**
         * Checks if a given link is compatible with the server's allowed link
         * settings. This is a client-side check to make life easier and to
         * avoid full-page errors.
         *
         * @static
         * @param {string} link The given link.
         * @return {boolean} Whether or not the given string is allowed.
         */
        static checkLink(link) {
            // TODO
        }

    }

});