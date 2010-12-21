To generate entities:
php app/console init:bundle "Application/ChiaBundle"
php app/console doctrine:generate:entity "Application\ChiaBundle" "Contact" --fields="name:string(255) description:text" --mapping-type="yml"


then add Bundle to app/AppKernel.php and run
php app/console doctrine:generate:entities
php hello/console doctrine:database:create
php hello/console doctrine:schema:create


publish assets:
php app/console assets:install --symlink web


You need to add this to twig.config in app/config/config.yml

    twig.config:
        form:
            resources: [ChiaBundle::form.twig]

    chia.menu: ~
    menu.twig: ~

    markdown.parser: ~
    markdown.twig: ~

    doctrine_user.config:
        db_driver: orm
        class:
            model:
                user: Application\ChiaBundle\Entity\User
                group: Application\ChiaBundle\Entity\Group
                permission: Application\ChiaBundle\Entity\Permission

    security.config:
        providers:
            main:
                password_encoder: sha1
                entity:
                    class: ChiaBundle:User
                    property: username


TODO:
- add view action to Contacts
- add hability to create new users
- Add people and projects in contact view
