# SecureDisplayBundle
MBOptimizationBundle is a small simple bundle which perform some optimization on the http response such adding security headers, compressing html, etc...

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/af0dd190-5fee-447c-94a2-0eb120d8cd7f/big.png)](https://insight.sensiolabs.com/projects/af0dd190-5fee-447c-94a2-0eb120d8cd7f)

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
        value:                          # optional : automatically add "self" to the list of sources
            - "'unsafe-inline'"
            - "'unsafe-eval'"
            - "data:"
            - "*.googleapis.com"
            - "*.gstatic.com"
            - "*.google.com"
            - "www.youtube.com"
            - "player.vimeo.com"
```
