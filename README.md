GeoDataPointCleanup-php
=======================

Clean a  set of geographic data points by removing erroneous entries.
Develop a program that, given a series of points (latitude, longitude, timestamp) for a cab journey from A to B, will disregard potentially erroneous points.

Overview
========
Leaflet.js was used to visualise the data both before it was cleaned and after it was cleaned.
Map.html shows both the uncleaned & cleaned data points on a map.

PHP was chosen to analyse the data points and identify potentially erroneous points.
An array of "cleaned" data points is produced and is written to a new CSV file which can then be rendered using Map.html
