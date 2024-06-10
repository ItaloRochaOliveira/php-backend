<?php
    use Doctrine\DBAL\DriverManager;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\ORMSetup;
    use Symfony\Component\Dotenv\Dotenv;

    require_once "../../vendor/autoload.php";

    $dotenv = new Dotenv();
    $dotenv->load(__DIR__ . '../../../.env');

    abstract class Configuration{
        private static $config;
        private static $connection;

        public static function connect() {
            self::$config = ORMSetup::createAttributeMetadataConfiguration(
                paths: array(__DIR__."/src/Entity"),
                isDevMode: true,
            );

            self::$connection = DriverManager::getConnection([
                'driver' => 'pdo_pgsql',
                'user'     => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'dbname'   => $_ENV['DB_DATABASE'],
                'host'     => 'localhost',
                'port'     => '5432',
            ], self::$config);

            return new EntityManager(self::$connection, self::$config);
        }
    }