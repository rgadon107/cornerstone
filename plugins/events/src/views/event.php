<?php
/**
 *  The single event view.
 */
namespace spiralWebDb\Events;

$metadata = 'Here is some metadata on the performance.';

echo '<p class="entry-meta" itemprop="performance-date">' . 'Performance Date: ' . $metadata . '</p>';
?>

<!--
<article class="post-(ID) events type-events status-publish entry" itemtype itemscope="https://schema.org/CreativeWork">
<!--May want to add a class 'events-{post-ID}' and change the itemscope. Check schema.org
for Musical Events. Register a cb to 'add_filter( 'genesis_attr_entry') to add attributes.-->
    <header class="entry-header">
        <h1 class="entry-title" itemprop="headline"><?php $post_title; ?></h1>
        <p class="entry-meta"><!--Replace Genesis' time & post-edit-link with
	the performance day and date--></p>
    </header>
    <div class="entry-content" itemprop="text"><!--Probably will be empty as
    the $post_content textfield is unused.-->
        <p><!--Performance Venue Name (bold text)--></p>
        <p><!--Performance Venue Address--></p>
        <p><!--Performance City & State--></p>
        <p><!--Link to Google Map to venue. Use FA fa-map-marker icon with link.--></p>
    </div>
    <footer class="entry-footer">
        <h3><!--Event Content Information--></h3>
        <p><!--Web URL--></p>
        <p><!--Sponsor Facebook Page--></p>
        <p><!--Sponsor Twitter Page--></p>
        <p><!--Sponsor Telephone Number--></p>
    </footer>
</article>