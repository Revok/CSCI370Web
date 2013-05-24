Colorado School Of Mines - Academic Computing & Networking

MARKETING SITE TEMPLATE FILES
Version 1.3


1. About This Release:
This package includes files used to create web sites that adhere to the style and layout guidelines of the Colorado School of Mines marketing site (http://mines.edu). Site owners and administrators can duplicate, rename, and edit the content of the templates in this package to create customized sites specific to their needs without investing a great deal of time (or money) in recreating existing Mines site styles or building a visually distinct site from scratch.

Templates included in this package are not intrinsically dynamic, meaning that page source code is included entirely within the .html file. As such, page headers, footers, navigation, and all other elements must be edited individually. In order to make a change to the navigation, the navigation elements on every page must be manually edited. That said, these page templates can be easily altered to work seamlessly with a server-side language like PHP, though Academic Computing & Networking will not support such installations. Site owners may also choose to make changes to the accompanying style sheets and template images. This is neither recommended nor supported.

Note that the templates in this package have been tested on the following browsers:
* Internet Explorer 6
* Internet Explorer 7
* Mozilla Firefox 3
* Safari 3.2

These templates may or may not display consistently in other browsers.

1.1 New in this release
* Removed logo.psd from /images/_psd/
* Modified all template source code to pull the search element from a centralized server location.


2. Files Included In This Release:
The following key files and directories are included with in this package. There are additional files contained within the directories listed here, but they are chiefly used as background images and icons, and as such, should not be edited, removed, or relocated.

2.1 .html files
* index.html (main index page)
* index_sidebar.html (main index page with optional sidebar)
* page.html (common page template)
* page_sidebar.html (page template with optional sidebar)
* about_us.html (generic "About Us" page based on page.html template)
* contact_us.html (generic "Contact Us" page based on page.html template)
* undergraduate_program.html (based on section.html template)
* graduate_program.html (based on section_sidebar.html template)
* faculty (generic faculty index page based on page.html template)
	* faculty_1.html (generic faculty member page based on page_sidebar.html template)
	* faculty_2.html (as above)
	* faculty_3.html (as above)
* site_map.html (generic site map page based on page.html template)

2.2 .css files
* css (directory containing seven files used for presentation)
	* globals.css (defines common HTML elements)
	* ie.css (style overrides specific to the Internet Explorer browser, version 7 and above)
	* ie6.css (style overrides specific to the Internet Explorer browser, version 6)
	* master.css (imports required .css files)
	* mines.css (the main custom style sheet)
	* print.css (defines print styles)
	* safari.css (style overrides specific to the Safari browser)

2.3 Image files
* images (directory containing key image files)
	* logo.gif (logo image used in all templates)
	* index_banner.jpg (large image used in index.html & index_sidebar.html templates)
	* section_banner.jpg (medium image used in section.html & section_banner.html templates)
	* _psd (directory containing raw Photoshop files for banner images)
	* _template (directory containing files called by style sheets)

Note that as you create subdirectories and pages within those subdirectories you must ensure that .css and image file paths remain correct.


3. Using This Release
This section discusses key considerations for site owners attempting to customize the files contained in this release.

3.1 Deploying the template files
Template files in this package must be deployed to a web server to be viewable by the general public. To do so, upload the files and directories listed above in Section 2 to a web sever via FTP or SFTP. Once the upload process is complete, you will be able to view the index.html file in a browser. The index.html file will become the default home page for its host directory. To create new pages for your web site, copy an existing page template, rename it (i.e.: "contact_us.html"), and deploy it to the appropriate web directory in the manner described above.

3.2 Changing the logo.gif file
The logo.gif file located in the images directory displays the name of an academic department and indicates its affiliation with the Colorado School of Mines. Out of the box, this file displays the following text on all template pages:

	"YOUR ACADEMIC DEPARTMENT"
	"Colorado School of Mines (550px wide)"

Clearly, this text should be changed. To do so, send an email to fstewart@mines.edu requesting a custom logo.gif image. Indicate the name of your academic department in the body of the email, and you will receive a custom logo.gif file for use on your site within two business days.

When you receive your custom logo.gif image, overwriting the existing logo.gif file in the template package's "images" directory. Refresh your browser to view the changes.

DO NOT change the overall dimensions of this file.

3.2 Changing the index_banner.jpg image
The index_banner.jpg image located in the images directory refers to the name of the large image used in the index.html and index_sidebar.html templates. Out of the box, this file displays the following text over a minimal background:

	"Your Image Goes Here"
	"1061px x 369px"

You may substitute your own image (and should probably do so) by overwriting images/index_banner.jpg with a 1061px (wide) x 369px (high) image of your own design. Note that each index.html and index_sidebar.html based page can have a distinct banner image. You may specify a banner image for each page by modifying the following code snippet found on each page:

<!-- Lead Art -->
<!-- modify the background-image:url path below to change the lead art -->
<div id="landingIMG" style="background-image:url(images/index_banner.jpg);">
<!-- /Lead Art -->

DO NOT change the overall dimensions of this file.

3.2.1 Optimizing Images
Site owners and administrators attempting to create customized index_banner.jpg and section_banner.jpg (discussed below) files should note that new, customized images should adhere to the width and height constraints specified on the image template (1061x369 and 755x269 pixels respectively). Deviation from these specifications will result in unintended image cropping and may cause the template display to break altogether. If you are unfamiliar with optimizing images for the web, refer to the following URL for a primer: http://www.tech-evangelist.com/2008/07/14/optimize-web-images-paint-shop-pro/. This tutorial refers to the Paint Shop Pro imaging application, but the principles are applicable to other imaging applications.

To summarize, image resizing best practices include:
* DO NOT alter the original image. Instead, make a copy of the image and optimize the copy.
* DO NOT resize images via HTML or CSS code. This method resizes the display, but not the file itself, which will result in longer page load times and pixelation/incorrect aspect ratio.
* DO NOT attempt to resize the image's width or height independently. Be sure to constrain the image proportions when resizing, or the image will display incorrectly. If an image is too wide or high, CROP the image to the correct dimensions.

3.3 Changing the section_banner.jpg image
The section_banner.jpg image located in the images directory refers to the name of the medium-size image used in the section.html and section_sidebar.html templates. Out of the box, this file displays the following text over a minimal background:

	"Your Image Goes Here"
	"755px x 269px"

You may substitute your own image by overwriting images/section_banner.jpg with a 755px (wide) x 269px (high) image of your own design. Note that each section.html and section_sidebar.html based page can have a distinct banner image. You may specify a banner image for each page by modifying the following code snippet found on each page:

<!-- Section Banner -->
<!-- change the image path below to change the banner image -->
<img src="images/section_banner.jpg" alt="Section Banner" />
<!-- /Section Banner -->

DO NOT change the overall dimensions of this file.

-----------------------------------------------
- Forrest Stewart (fstewart@mines.edu) 01/23/09