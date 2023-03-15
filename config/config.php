<?php

if ($_SERVER["HTTP_HOST"] === "localhost" || $_SERVER["HTTP_HOST"] === "127.0.0.1") {
    return [
        "database" => [
            "host" => "localhost",
            "database" => "testdb",
            "username" => "testaccount",
            "password" => "test",
        ],
    ];
} else {
    return [
        "database" => [
            "host" => "mysql74.onamae.ne.jp",
            "database" => "kc5dn_test_db",
            "username" => "kc5dn_admin",
            "password" => "!testtest1111",
        ],
    ];
}

/*
return [
    "database" => [
        "host" => "localhost",
        "database" => "testdb",
        "username" => "testaccount",
        "password" => "test",
    ],
];*/

/**
 * host localhost
 * database testdb
 * username testaccount
 * password test
 */
