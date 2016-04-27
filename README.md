# PHP-Final

<h2> Installation Instructions </h2>
<h3>Step 1</h3>
<p>Clone the repo and save it under C:\xampp\htdocs\PHP-Final </p>

<h3> Step 2</h3>

<p>Upload the database.sql file to phpmyadmin. </p>
<p>If login to phpmyadmin is not root with no password, change the credentials at /BookingApp/init.php </p>

<h3>Step 3</h3>

<p> Open XAMPP Control Panel </p>
<p> Apache -> Config -> Httpd.conf </p>
<p>Paste these lines at the bottom of the file</p>

<p>
<code>
<VirtualHost *:80>
DocumentRoot "C:\xampp\htdocs\PHP-Final\StudioBookingApp\public"
</VirtualHost>

<Directory "C:\xampp\htdocs\PHP-Final\StudioBookingApp">
   Order allow,deny
   AllowOverride all
   Allow from all
   Require all granted
</Directory>

<Directory "C:\xampp\htdocs\PHP-Final\StudioBookingApp\public">
   Order allow,deny
   AllowOverride all
   Allow from all
   Require all granted
</Directory>
</code>
</p>

<h3>Step 4 </h3>
<p>Done! To access the app, go to http://localhost </p>