IbrowsXeditableBundle
=============================

x-editable ( http://vitalets.github.io/x-editable/ ) symfony2 forms integration


Install & setup the bundle
--------------------------

1. Add IbrowsXeditableBundle in your composer.json:

	```js
	{
	    "require": {
	        "ibrows/xeditable-bundle": "~1.0",
	    }
	}
	```

2. Now tell composer to download the bundle by running the command:

    ``` bash
    $ php composer.phar update ibrows/xeditable-bundle
    ```

    Composer will install the bundle to your project's `ibrows/xeditable-bundle` directory. ( PSR-4 )

3. Add the bundles to your `AppKernel` class

    ``` php
    // app/AppKernerl.php
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Ibrows\XeditableBundle\IbrowsXeditableBundle(),
            // ...
        );
        // ...
    }
    ```

4. Include JS-Lib and CSS Files

    ```
            {% javascripts
                '@IbrowsXeditableBundle/Resources/public/javascript/bootstrap.editable-1.5.1.js'
                '@IbrowsXeditableBundle/Resources/public/javascript/xeditable.js'
            %}
                <script type="text/javascript" src="{{ asset_url }}"></script>
            {% endjavascripts %}
    ```



    ```
            {% stylesheets
                'bundles/ibrowsxeditable/x-editable/css/bootstrap-editable.css'
            %}
                <link rel="stylesheet" type="text/css" media="screen" href="{{ asset_url }}" />
            {% endstylesheets %}
    ```