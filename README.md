# Senior-Project

## Background 

This project is designed to implement a system to better monitor customer wait times at restaurants. 
An overhead camera will monitor a table. If the table is assigned a party the camera will begin monitoring the following:
  * The time it takes for a server to initially come out and help a table
  * The time it takes for servers to return and service the table 
  * Keep a log of the longest wait times for customer service and the current wait time
  * Update a graphical user interface so that restaurant employees can see:
    * The tables they are assigned
    * The current wait time and longest wait time for their table 
    * Relevant information about a table, such as the party size and possibly their order 
  * Manager should be able to see ALL data to better manage their restaurant
  
##### Project Proposal 
https://docs.google.com/presentation/d/1pL1QMqYTGmEKIimaEB2GFDp6prVjLeNeHyP6_zPkJR8/edit?usp=sharing
##### Progress PowerPoint 10/25/19 
https://docs.google.com/presentation/d/12ryh_gbVDI38bCMw_pBnhEDPErOkqdGwdQsppLydOWI/edit?usp=sharing
##### Progress PowerPoint 11/15/19 
https://docs.google.com/presentation/d/1K5gPpmaFp34ox9BWwKEeN1l4HxI4nA46s05T6kfbJ8w/edit?usp=sharing
##### Progress PowerPoint 12/6/19  
https://docs.google.com/presentation/d/1p5kIT53EJf4JWpQrycAwZvCr6VEaUx137DjtoCy2ZXI/edit?usp=sharing

### Camera Recognition (OpenCV)

We will be using OpenCV, an open source camera vision library, for the camera portion of the project. 
For facial recognition we will use OpenCV's facial landmarking and write a simple comparison function to identify 
if two faces are the same. 

The overhead camera implementation is still in the design phase. We will probably use colored hats on servers to identify 
what type of service is currently being performed. 

### Host/Server user interface 

A web application is being created that contains three main pages.

* Login Screen 
  * Use facial recognition to login in an employee 
* Host/Hostess Interface
  * Host/Hostess can add a party
  * Remove a party 
  * See what tables are opened and assign a server to a party 
* Server Interface 
  * Server can see what tables are assigned to them
  * Can click on a table and see relevant information, such as food order,
    party leader name, and other features we will add as we go
  * Can see the wait times for their tables including the longest wait times and current wait time
#### Resources/Technologies 
OpenCV, JsonCPP, PHP, C++, HTML/CSS, Javascript, PostgreSQL DBMS


