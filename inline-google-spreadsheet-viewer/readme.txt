=== Plugin Name ===
Contributors: meitar
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=TJLPJYXHSRBEE&lc=US&item_name=Inline%20Google%20Spreadsheet%20Viewer&item_number=Inline%20Google%20Spreadsheet%20Viewer&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: Google Docs, Google, Spreadsheet, shortcode
Requires at least: 3.3
Tested up to: 3.9.1
Stable tag: 0.4.6

Embeds a public Google Spreadsheet in a WordPress post or page as an HTML table.

== Description ==

Fetches a publicly shared Google Spreadsheet using a `[gdoc key=""]` WordPress shortcode, then renders it as an HTML table, embedded in your blog post or page. The only required parameter is `key`, which specifies the document you'd like to retrieve. Optionally, you can also strip a certain number of rows (e.g., `strip="3"` omits the top 3 rows of the spreadsheet) and you can supply a table `summary`, `<caption>` and customized `class` value.

Your spreadsheet must be shared [using either the "Public on the web" or "Anyone with the link" options](https://support.google.com/drive/?p=visibility_options&hl=en_US). Currently, private Google Spreadsheets or Spreadsheets shared with "Specific people" are not supported.

After setting the appropriate Sharing setting, copy the URL you use to view the Spreadsheet from your browser's address bar into the shortcode. For example, to display the spreadsheet at `https://docs.google.com/spreadsheets/d/ABCDEFG/edit`, use the following shortcode in your WordPress post or page:

    [gdoc key="https://docs.google.com/spreadsheets/d/ABCDEFG/edit"]

If your spreadsheet uses the "old" Google Spreadsheets, you need to [ensure that your spreadsheet is "Published to the Web"](https://docs.google.com/support/bin/answer.py?hl=en&answer=47134) and you need to copy only the "key" out of the URL. For instance, if the URL of your old Google Spreadsheet is `https://docs.google.com/spreadsheets/pub?key=ABCDEFG`, then your shortcode should look like this:

    [gdoc key="ABCDEFG"]

To render the HTML table with additional metadata, you can also do the following:

    [gdoc key="ABCDEFG" class="my-sheet" summary="An example spreadsheet, with a summary."]This is the table's caption.[/gdoc]

The above shortcode will produce HTML that looks something like the following:

    <table id="igsv-ABCDEFG" class="igsv-table my-sheet" summary="An example spreadsheet, with a summary.">
        <caption>This is the table's caption.</caption>
        <!-- ...rest of table code using spreadsheet data here... -->
    </table>

You can use the `gid` attribute to embed a worksheet other than the first one (the one on the far left). For example, to display a worksheet published at `https://spreadsheets.google.com/pub?key=ABCDEFG&gid=4`, use the following shortcode in your WordPress post or page:

    [gdoc key="ABCDEFG" gid="4"]

The `header_rows` attribute lets you specify how many rows should be rendered as the [table header](http://reference.sitepoint.com/html/thead). For example, to render a worksheet's top 3 rows inside the `<thead>` element, use:

    [gdoc key="ABCDEFG" header_rows="3"]

All tables are progressively enhanced with jQuery [DataTables](https://datatables.net/) to provide sorting, searching, and pagination functions on the table display itself. If you'd like a specific table not to include this functionality, use the `no-datatables` `class` in your shortcode. For instance:

    [gdoc key="ABCDEFG" class="no-datatables"]

Web addresses and email addresses in your data are turned into links. If this causes problems, you can disable this behavior by specifying `no` to the `linkify` attribute in your shortcode. For instance:

    [godc key="ABCDEFG" linkify="no"]

== Installation ==

1. Upload `inline-gdocs-viewer.php` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Use the `[gdoc key="ABCDEFG"]` shortcode wherever you'd like to insert the Google Spreadsheet.

== Frequently Asked Questions ==

= The default style is ugly. Can I change it? =
Yes, if you're able to change your theme's style sheet. The plugin renders HTML with plenty of [CSS](http://en.wikipedia.org/wiki/Cascading_Style_Sheets) hooks. Use the `igsv-table` class from your style sheets to target the plugin's `<table>` element.

Additionally, each row (`<tr>`) and cell (`<td>`) is assigned a specific `class` attribute value. The first `<tr>` element is assigned the `row-1` class, the second is assigned `row-2`, and the last `row-N` where `N` is the number of rows in the rendered table. Similarly, each cell is assigned a class based on its columnar position; the first cell in a row is assigned the `col-1` class, the second `col-2`, and so on:

    .igsv-table .row-2 .col-5 { /* styles for the cell in the 2nd row, 5th column */ }

Finally, both rows and cells (based on columns) are assigned an additional class of either `odd` or `even`, allowing for easy zebra-striping in [CSS3](http://www.w3.org/TR/css3-selectors/) non-conformant browsers.

    .igsv-table tr.odd  { /* styles for odd-numbered rows   (row 1, 3, 5...) */ }
    .igsv-table tr.even { /* styles for even-numbered rows  (row 2, 4, 6...) */ }
    .igsv-table td.odd  { /* styles for odd-numbered cells  (column 1, 3, 5...) */ }
    .igsv-table td.even { /* styles for even-numbered cells (column 2, 4, 6...) */ }

= A table appears, but it's not my spreadsheet's data! And it looks weird! =
You should triple-check that you've published your spreadsheet. Google provides instructions for doing this. Be sure to follow steps 1 and 2 in [Google Spreadsheets Help: Publishing to the Web](http://docs.google.com/support/bin/answer.py?hl=en&answer=47134).

= Can I remove certain columns from appearing on my webpage? =
While you can't strip out columns like you can do with rows, you can [hide columns using CSS](http://maymay.net/blog/projects/inline-google-spreadsheet-viewer/comment-page-2/#comment-294582) with code such as, `.col-4 { display: none; }`, for example.

== Change log ==

= Version 0.4.6 =

* Update to support Google's new `gid` attribute requirements. (Dear Google, please stop changing things, sincerely, [a homeless hacker who survives thanks to donations for free software](http://maymay.net/).)

= Version 0.4.5 =

* Bugfix: Correctly output the table's `id` attribute for "new" Google Spreadsheets.
* Security: Added additional output escaping.

= Version 0.4.4 =

* Enhancement: Update DataTables library to version 1.10. Notably, this brings [client-side DataTable ordering (sorting) capability](https://datatables.net/reference/api/order%28%29) to your theme's JavaScripts.
* Feature: Include DataTables [ColVis](https://datatables.net/extensions/colvis/) and [TableTools](https://datatables.net/extensions/tabletools) extensions by default.

= Version 0.4.3 =

* Feature: "New" Google Spreadsheets are now officially supported.

= Version 0.4.2 =

* Feature: Detect Web addresses and email addresses and turn them into clickable links. Optionally disable this behavior by adding `linkify="no"` to your shortcode.

= Version 0.4.1 =

* Bugfix: Correctly pass `gid` attribute.

= Version 0.4 =

* Feature: Support the "new" Google Spreadsheets through HTML parsing.
    * *This feature is experimental and is not recommended for production websites because [Google's "new" Google Spreadsheets are still under active development](https://support.google.com/drive/answer/3543688).* I strongly suggest you continue to use the "old" Google Spreadsheets for any documents with which you use this plugin. More information about [reverting back to the old Google Spreadsheets](https://support.google.com/drive/answer/3544847#workarounds) is available on Google's help page.

= Version 0.3.3 =

* Bugfix: Correctly load search/sort/filter JavaScript on some systems where it failed.

= Version 0.3.2 =

* Adds jQuery [DataTables](//datatables.net/) plugin to provide column sorting, searching, and pagination. All tables will have DataTables's features applied. If you'd prefer to stick with the old, static table, use the `no-datatables` `class` when calling it. For instance, `[gdoc key="ABDEFG" class="no-datatables"]`. This also means the plugin now requires WordPress version 3.3 or later.

= Version 0.3.1 =

* Bugfix for "Invalid argument supplied for foreach()" when using built-in PHP `str_getcsv()`.
* Bugfix for some situations in which debugging code caused a fatal error.

= Version 0.3 =

* Implements `header_rows` attribute in shortcode to allow rendering more than 1 header row.
* Fetches data using `wp_remote_get()` instead of `fopen()` for portability; now requires WordPress 2.7 or higher.
* Updates plugin internals; uses PHP 5.3's `str_getcsv()` function if available.

= Version 0.2 =

* Implements `gid` attribute in shortcode to allow embedding of non-default worksheet.
* Updates plugin internals; now requires WordPress 2.6 or higher.

= Version 0.1 =

* Initial release.
