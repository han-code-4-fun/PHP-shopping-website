# PHP-shopping-website

This is a shopping website that includes customer accounts registration and verification, music databases, music shopping cart and other necessary webpage. 

The entire website is coded with PHP.

# Installation

#### Any operating system supports IDE    <br /><br />
    
#### Any IDE supports PHP: Notepad++, Microsoft Visual Studio, Visual studio code, Codelobster etc.
  - To download Notepad++ [Click here](https://notepad-plus-plus.org/download/v7.5.8.html)
  - To download Codelobster [Click here](http://www.codelobster.com/download.html) Note: prefered to download the PHP edition<br /><br />
  
  
#### WAMP(Windows, Apache, MySQL, and PHP) software
  - To download WAMP [Click here](http://www.wampserver.com/en/) Note: You need to remember where you installed this for later use<br /><br />
  
# How to use source code file<br /><br />
:point_right:Professional guide <br /><br />
Download and unzip, put folder under **WAMP/www** folder, create database **musicbuydb** and import tables from folder **dboutput**. Go to **localhost** from WAMP, find and open file **index.php** to begin. Don't forget to read the **Assignment4.doc** for project requirement.<br /><br /><br />
:point_right:Beginner guide<br />
#### Step 1 Download source file
Download source file(**PHP music shopping website.zip**) and upzip it (you would get **PHP music shopping website** folder).<br /><br />
#### Step 2 Save file into right path
Find a folder called **www** under WAMP installation folder and move entire (unzipped) folder inside **www** 
  - If you installed WAMP in E:\WAMP then the folder would be E:\WAMP\www<br /><br />
#### Step 3 Read project requirement before check the outcome
Read **Assignment4.doc** in the **PHP music shopping website** folder for an understanding of the project requirement. And yes, it's From Professor Gilert Tsui.<br /><br />
#### Step 4 open WAMP
Open WAMP, a small icon will appear at the notification area of the Task bar (normally at your bottom-right cornor close to your system time), wait for few seconds until it turns green.
  - Note: if WAMP cannot turn to green, it won't work. It is suggested to turn off other server/proxy related softwares before using WAMP.
  - if still not working, try to re-install WAMP
  - if still not working, try to google for question<br /><br />
### Step 5 Import Databases
1.**left-click** WAMP icon and select **phpMyAdmin**
2.enter default username **root** and leave password empty then click go button
3.At left panel Click **New** to create a new database then enter **musicbuydb** exactly into the database name inbox then click create
4.At left panel Click the newly created **musicbuydb** then Click **Import** tab on top
5.Click Browse button to browse file in your system, navigate to **dboutput** under **PHP music shopping website** folder, select one of the tables file (end with .sql) and click **open**, scroll down to the bottom of the page click **Go** button
6.Repeat step 4,5 to import all the files
7.To check if data entered correctly: 
 - **left-click** WAMP icon go to **MySQL** -> **MySQL console**
 - at the command window, hit **Enter** on your keyboard
 - Then you type in **use musicbuydb;** (include ";") Correct result is "Database changed"
 - type **show tables;** Correct result would be seeing the tables name
 - type **select * from customertbl;** to check if the data is there. Note that you can try to remember one customer's lastname and password for later testing
 - repeat last step, changed the table name after **from** to check all tables data
8.Check storage engine: open file **Assignment4.doc** on page 26, follow the instruction to make sure **MyISAM** is selected for storage engine for all tables

### Step 6 Test website
**left-click** WAMP icon and select **Localhost**
Click **PHP music shopping website** from the pop-up browser
Click **index.php** to begin 





# More information

Welcome any feedback and comments











 
