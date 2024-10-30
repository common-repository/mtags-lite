=== Mtags Lite ===  
Contributors: wanderlima
Donate link: http://plugins.wanderlima.com/
Tags: Tags: keywords, meta, tags, description, seo
Requires at least: 3.0
Tested up to: 3.1.2
Stable tag: 1.0

Simple plugin that put description and keywords for all pages and posts of your blog and clean unnecessary info in wp_head() for secure reasons.
             
== Description ==

Simple plugin that put description and keywords for all pages and posts of your blog and clean unnecessary info in wp_head() for secure reasons.

*  Keywords: user default keywords Tags
*  Description: user default Description
*  Remove: rsd_link, wlwmanifest_link, wp_generator, start_post_rel_link, index_rel_link, adjacent_posts_rel_link

Mtags Lite languages: English and Portuguese (Brazil).

For more information visit the [Documentation Page](http://plugins.wanderlima.com/).

== Installation ==

Always take a backup of your db before doing the upgrade, just in case ...  
1. Upload the `mtags-lite` folder to the `/wp-content/plugins/` directory  
2. Activate the plugin through the 'Plugins' menu in WordPress  
3. Update the fields with your Keywords and Blog Description following the instructions in the Usage section.  

== Frequently Asked Questions ==

= Is Mtags Lite available in my language? = 

At this stage, Mtags Lite is only available in English and Portuguese (Brazil).

== Screenshots ==

1. Mtags Lite form.
2. Mtags Lite options page.

== Changelog ==

= 0.1 =
* This version is the first one, but is write to be compatible with new releases, stay tunned!

= 1.0 =
* New options, now you can decide if wanna list post terms + default tags and same with post description. 
* Select what you want to remove from your <head> rsd_link, wlwmanifest_link, wp_generator, start_post_rel_link, index_rel_link, adjacent_posts_rel_link

== Upgrade Notice ==

= 0.1 =
This version is the first one, but is write to be compatible with new releases, stay tunned!

= 1.0 =
* New options, now you can decide if wanna list post terms + default tags and same with post description. 
* Select what you want to remove from your <head> rsd_link, wlwmanifest_link, wp_generator, start_post_rel_link, index_rel_link, adjacent_posts_rel_link
* Code optimezed.

== Upgrade ==

* New options, now you can decide if wanna list post terms + default tags and same with post description. 
* Select what you want to remove from your <head> rsd_link, wlwmanifest_link, wp_generator, start_post_rel_link, index_rel_link, adjacent_posts_rel_link
* Code optimezed.

== Usage == 

After the installation, Mtgas Lite add a top level "Mtags Lite" menu to your Wordpress Administration.

*  The *Mtags Lite* page lets you update your Keywords and Blog Description.
        - Keywords: Comma-separated keywords (255 chars limit).
        - Description: Blog´s description (255 chars limit).
        - Update: Update time, be honest or search engines can do restrictions to your Blog.

*  The *Options* page lets you decide the plugin behaviour.
        - Keywords: Post Tags / Default Tags / Post Tags + Default Tags.
        - Description: Post Excerpt / Default Excerpt / Post Excerpt + Default Excerpt.
        - Aditional options: Select what you want to remove from your <head> rsd_link, wlwmanifest_link, wp_generator, start_post_rel_link, index_rel_link, adjacent_posts_rel_link.