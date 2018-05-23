<?php
/**
 *  The single event view.
 */
namespace spiralWebDb\Events;

$metadata = 'Here is some metadata on the performance.';

echo '<p class="entry-meta" itemprop="performance-date">' . 'Performance Date: ' . $metadata . '</p>';
?>

<!-- -->
<article class="post-(ID) events type-events status-publish entry events-301" itemscope
         itemtype="https://schema.org/MusicEvent">
    <header class="entry-header">
        <!--Modified 'entry-title' wrap & atts in 'single-events.php' file.-->
        <!--Filter the entry-title and prepend either the venue image file or
        <!--use the Font Awesome 'music' icon'-->
        <!--TODO: Figure out how to prepend FA in a post title.-->
        <h2 class="entry-title" itemprop="location" itemtype="https://schema.org/MusicVenue"><?php $post_title; ?></h2>
        <!--Build the 'events/src/meta.php' file to call the post metadata-->
        <!--Build the performance day, date, and time.-->
        <!--Build the 'post-meta-before-entry' view file.-->
        <!--Call the 'post-meta-before-entry' view file to render the entry meta.-->
        <p class="entry-meta"></p>
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