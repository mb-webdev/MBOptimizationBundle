# SecureDisplayBundle
MBOptimizationBundle is a small simple bundle which perform some optimization on the http response such adding security headers, compressing html, etc...

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/2e682a6f-3671-41bd-968c-25c1ae261c44/big.png)](https://insight.sensiolabs.com/projects/2e682a6f-3671-41bd-968c-25c1ae261c44)

[![Latest Stable Version](https://poser.pugx.org/mb-webdev/optimization-bundle/v/stable)](https://packagist.org/packages/mb-webdev/optimization-bundle)
[![License](https://poser.pugx.org/mb-webdev/optimization-bundle/license)](https://packagist.org/packages/mb-webdev/optimization-bundle)

## Installation

### Step 1: Composer
First you need to add `MB/optimization-bundle` to `composer.json`:

```json
{
   "require": {
        "mb/optimization-bundle": "dev-master"
    }
}
```
note: replace `dev-master` with the last version of this bundle.

### Step 2: AppKernel
Register the bundle into the Symfony AppKernel
```php
// app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            ...
            new MB\Bundle\OptimizationBundle\MBOptimizationBundle()
        );

        return $bundles;
    }
}
```

### Step 3: Config
Define the configuration of the bundle into the config file
```yaml
# app/config/config.yml
mb_optimization:
    html_compress: false                # optional : compress html output (spaghetti code)
    x_frame_options:
        enabled: false                  # required : enable/disable X-Frame-Options header
        value: SAMEORIGIN               # optional : value of this header attribute (default value : "SAMEORIGIN")
    x_xss_protection:
        enabled: false                  # required : enable/disable X-XSS-Protection header
        value: "1; mode=block"          # optional : value of this header attribute (default value : "1; mode=block")
    content_security_policy:
        enabled: false                  # required : enable/disable Content-Security-Policy header
        value:                          # optional : array of values for this header attribute (automatically add "self" to the list of sources)
            - "source1.com"
            - "source2.com"
            - "*.source3.com"
```
