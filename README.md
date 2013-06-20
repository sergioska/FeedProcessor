FeedProcessor
=============

Feed Processor Bundle For Symfony

This bundle run in symfony 2 as a service and provide support to read rss feeds (and xml in general) and xslt support to trasform xml files with xsl stylesheet help.

In your controller you can use it, follow below instructions:


    $oFeed = $this->get('feed_manager');
    $oFeed->setXsl(<path_to_xsl>/Example.xsl');
    $oFeed->setFeed("http://feeds.feedburner.com/symfony/blog");
    $sXmlRes = $oFeed->process();




