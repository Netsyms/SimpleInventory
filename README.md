SimpleInventory
===============

A simple inventory system.

Items have categories and locations, and also some barcodes and notes if you want.

Setup
-----

Copy settings.template.php to settings.php and configure.

By default, it connects to an LDAP server for authentication using php-ldap.  
See the `authenticate_user` function in `required.php` to change or replace that.  
You'll probably want to edit the search filter at minimum.

The database was created with MySQL Workbench.  Open `databasemodel.mwb` to 
and forward-engineer the SQL create code.

Label Printing
--------------

This app has the ability to print inventory labels on a Brother QL-series 
printer loaded with standard address labels.  Tested with a QL-500.  
Basically, it creates an image and runs a shell command to print.  Edit the 
command in `settings.php`.  To adjust the image generation, go and open 
`api/printlabel.php`.

License
-------
MIT