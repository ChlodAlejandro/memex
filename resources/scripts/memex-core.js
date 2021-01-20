/*
 * This is the Memex core JavaScript file, which will handle all Memex-related
 * activity on the client side. This also includes API contact and basic type
 * checking.
 *
 * @author Chlod Alejandro <chlod@chlod.net>
 * @license Apache-2.0
 */

// All things begin here, so let's assign the global Memex variable.
/**
 * The global Memex variable. Used for contacting the Memex JS core from
 * UI and other places.
 *
 * @global
 * @type Record<string, any>
 */
window.memex = {};

/**
 * Handles errors and displays the appropriate dialogs.
 *
 * @class MemexError
 * @type {memex.MemexError}
 */
memex.errors = memex.err = class MemexError {

    /**
     * Handles an error.
     *
     * @static
     * @param {Error} error
     */
    static handleError(error) {
        console.error(error);
    }

}

/**
 * Loads in extra JavaScript files if they haven't been loaded yet.
 *
 * @class MemexDependencies
 * @type {memex.MemexDependencies}
 */
memex.dependencies = memex.dep = class MemexDependencies {

    static registeredDependencies = [];

    /**
     * A callback which is run if the dependency was not registered earlier. If you wish
     * to modify the Memex global, consider returning any object instead.
     *
     * @callback registerCallback
     * @return Promise<any> | any
     */

    /**
     * Register a dependency if it hasn't been registered yet.
     *
     * @static
     * @param {string} name The name of the dependency.
     * @param {registerCallback} [callback] The callback to run if the dependency has been registered.
     * @return {Promise<boolean>} Whether or not the dependency was registered.
     */
    static async register(name, callback) {
        if (name.length === 0) {
            throw "Specify a valid dependency name.";
        }

        if (this.registeredDependencies.includes(name)) {
            return false;
        } else {
            this.registeredDependencies.push(name);
            try {
                if (callback) {
                    const dependency = await callback();
                    if (dependency != null) {
                        const dependencyParts = name.split(".");
                        let currentPart = memex;
                        for (let partIndex = 0; partIndex < dependencyParts.length; partIndex++) {
                            const part = dependencyParts[partIndex];
                            if (part.length === 0)
                                throw "Cannot create a dependency with empty parts.";

                            if (partIndex === dependencyParts.length - 1)
                                currentPart[part] = dependency;
                            else
                                currentPart = currentPart[part] = currentPart[part] || {};
                        }
                    }
                }
            } catch (e) {
                memex.err.handleError(e);
            }
        }
    }

}

// Register ourselves when all is done.
memex.dep.register("core");