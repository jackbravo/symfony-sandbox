To generate entities:
php app/console init:bundle "Application/ChiaBundle"
php app/console doctrine:generate:entity "Application\ChiaBundle" "Contact" --fields="name:string(255) description:text" --mapping-type="yml"


then add Bundle to app/AppKernel.php and run
php app/console doctrine:generate:entities
php hello/console doctrine:database:create
php hello/console doctrine:schema:create


publish assets:
php app/console assets:install web


You need to add this to twig.config in app/config/config.yml

    twig.config:
        form:
            resources: [ChiaBundle::form.twig]
