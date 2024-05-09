<?php

function getDatabaseConfig(): array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=percetakan_db",
                "username" => "root",
                "password" => "1234"
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=percetakan_db",
                "username" => "root",
                "password" => "1234"
            ]
        ]
    ];
}
