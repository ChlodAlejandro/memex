<?php

// MEMEX
//
// A simple URL shortener.
//
// Copyright (c) 2020 Chlod Aidan Alejandro. Released under the Apache License 2.0.
//
//
// This is loaded on nearly every single Memex API endpoint and
// on multiple important pages. If you're changing it, you need
// to fully know what you're doing.
//
// If you do happen to know what you're doing, consider
// contributing to Memex on its GitHub repository.

namespace Memex;

require_once __DIR__ . "/autoload.php";

use Memex\Errors\ErrorHandler;
use Memex\Data\Configuration;

// Absorb all shutdowns
if (!MEMEX_DEBUG)
    register_shutdown_function(function () { ErrorHandler::shutdown(); });

// Load configuration
Configuration::loadConfiguration();