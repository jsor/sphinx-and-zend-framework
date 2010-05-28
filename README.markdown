Sphinx and Zend Framework
=========================

This repository shows the integration of [Sphinx](http://sphinxsearch.com) into
a [Zend Framework](http://framework.zend.com) application.
It is a reference implementation accompanying a series of posts about Sphinx and
SphinxSE on my [blog](http://sorgalla.com/serien/schoener-suchen-mit-sphinx/).

Features
--------

### Configuration

The application contains a sample [configuration file](http://github.com/jsor/sphinx-and-zend-framework/blob/master/application/configs/sphinx.conf)
for Sphinx. It shows that the file can be processed by a scripting language (PHP here of course)
and utilizes Zend_Application for fetching global options (like database credentials) from
[application.ini](http://github.com/jsor/sphinx-and-zend-framework/blob/master/application/configs/application.ini-dist).

### Adapter for Zend_Paginator

[Jsor_Paginator_Adapter_DbSelectSphinxSe](http://github.com/jsor/sphinx-and-zend-framework/blob/master/library/Jsor/Paginator/Adapter/DbSelectSphinxSe.php)
implements a Zend_Paginator adapter using SpinxSE.

The [IndexController](http://github.com/jsor/sphinx-and-zend-framework/blob/master/application/controllers/IndexController.php)
shows a example usage of the adapter.

### Commandline script for Sphinx

The application provides a [script](http://github.com/jsor/sphinx-and-zend-framework/blob/master/scripts/sphinx)
for starting, stopping and restarting the Sphinx daemon and for starting the indexer.

Disclaimer
----------

This is not a production-ready application!

Prerequisites
-------------

You must have installed [Sphinx 0.9.9+](http://sphinxsearch.com) with
[SphinxSE](http://sphinxsearch.com/docs/current.html#sphinxse).

The application is not packaged with the Zend Framework. Prior to use, you should
ensure Zend Framework 1.9.7+ is available from your include_path.

You can either copy/link it to the `libary` folder or install it via PEAR.
The (unofficial) PEAR Channel can be found at <http://pear.zfcampus.org>.

In line with recent Zend Framework versions, PHP 5.2.6 is the lowest supported
version supported though it is strongly recommended the latest PHP version be
used.

Installation
------------

1. Install Zend Framework to your include_path as described above.

2. Copy the application to your destination of choice and ensure any intended
Virtual Host is pointing to the `public` directory as the Host's document
root. The `data` directory should be writeable from PHP.

3. Copy or rename the `application/configs/application.ini-dist` to
`application/configs/application.ini`.

4. Create a new database (and optionally user). Edit the
`application/configs/application.ini` to reflect these details.

5. Import the dump from `data/sphinx_example.sql` to the database.

6. Use `scripts/sphinx` to create the search index and start the search daemon:

        $ ./scripts/sphinx index-all
        $ ./scripts/sphinx start

7. Point your browser to http://your-vhost/ to see a basic example search form.