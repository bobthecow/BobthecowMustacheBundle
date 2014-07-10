MustacheBundle
==============

A Symfony implementation of the Mustache template rendering. This will add Mustache as a renderer in Symfony

1) Installing
-------------

### Composer

Just run following command with composer:

    composer.phar require bobthecow/mustache-bundle

Lookup desired version constraint from packagist. After adding this run

    composer.phar update


### AppKernel

To actually download and use this bundle. Also add following line to your `AppKernel.php`

    new Bobthecow\Bundle\MustacheBundle\BobthecowMustacheBundle()


### config.yml

Add rendererer to your config.yml

    framework:
        templating:
            engines: ['twig', 'mustache']


2) Using it
-----------

Like you would use twig. Just put your mustache file in your Resources\views folder using `.mustache` as extension.
E.g.

        // Render Mustache template and return response
        return $this->render('AcmeDemoBundle:Hello:index.html.mustache');

Or pass along the template in the Template() annotation

        /**
         * @Template("AcmeDemoBundle:Hello:index.html.mustache")
         */
         public function indexAction()
         {
             return array();
         }


