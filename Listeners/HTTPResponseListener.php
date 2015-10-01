<?php
/*
 * This file is part of the MBOptimization package.
 *
 * (c) Michael Barbey <michael@mb-webdev.ch>
 *
 * Do not distribute this file or any part of this package without the official authorizazion of mb-webdev
 */

namespace MB\Bundle\OptimizationBundle\Listeners;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
class HTTPResponseListener
{
    private $policy;
    private $xss;
    private $frame;
    private $compress;

    public function __construct(array $config) {
        $this->policy = $config['content_security_policy'];
        $this->xss = $config['x_xss_protection'];
        $this->frame = $config['x_frame_options'];
        $this->compress = $config['html_compress'];
    }

    public function changeHeaders(FilterResponseEvent $event)
    {
        $headers = $event->getResponse()->headers;

        if($this->policy['enabled']) {
            $allow = array_merge(array("'self'"), $this->policy['value']);

            $headers->set('Content-Security-Policy', "default-src " . implode(' ', $allow));
        }

        if($this->frame['enabled']) {
            $headers->set('x-Frame-Options', $this->frame['value']);
        }

        if($this->xss['enabled']) {
            $headers->set('x-XSS-Protection', $this->xss['value']);
        }
    }

    public function trimContent(FilterResponseEvent $event)
    {
        if($this->compress) {
            $content = $event->getResponse()->getContent();
            $content = preg_replace("/([\n|\r]\s*)/ms", " ", $content);
            $event->getResponse()->setContent($content);
        }
    }
}
