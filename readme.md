# empa-Assign
Empatica Assignment

This is my implementation of the assignment by Empatica people.

<a href="http://52.32.228.74/empaAssignment/public" target="_blank">DEMO</a>


<h1>THE BACK END</h1>

<h2>The REST SERVICES</h2>

A series of rest services that consume and produce json data.<BR>
All the rest services are under jwt authentication<BR>

/api/logIn      It creates a jwt token, sets a http only cookie(in production it must be also with secure flag) and returns a json response with the created token.<BR>
input: {"username":"xxxxxx","password":"yyyyyy"}<BR>


/api/getTemp     it returns in json the values contained in TEMP.csv <BR>
/api/getEda      it returns in json the values contained in EDA.csv <BR>
/api/getAcc      it returns in json the module of the x,y,z values from ACC.csv <BR>
/api/getHr       it returns in json the values contained in HR.csv <BR>

the returned json format: {"t":time,"f":freq, "d":[val1,val2,val3,val4................. <BR>
t: start time in milliseconds <BR>
f: frequency <BR>
d: the data <BR>

/api/getUsers    it returns in json the user list <BR>
/api/getDevices  it returns in json the device list <BR>
/api/getSessions it returns in json the session list <BR>
/api/createUser  it creates an user <BR>

<h2>DATABASE</h2> <BR>
users: user credentials for authentication <BR>
user_profile: user profile ("admin","doctor","operator","user") <BR>
sessions: the user sessions <BR>
role_permissions: the permission for the every role <BR>
devices: the device list <BR>

<h2>THE DATA SOURCES</h2><BR>
ACC.csv, EDA.csv, HR.csv, TEMP.csv<BR>

<h2>FRAMEWORK AND PLATFORMS</h2><BR>
php, laravel, MySql, Json Web Token (<a href="https://github.com/tymondesigns/jwt-auth/wiki/Authentication">tymondesign</a>)<BR>

<h1>THE FRONT END</h1>
for signing in the following users are available (username,password):<BR>
admin role:  "admin","admin"<BR>
operator role:  "oper1","oper1"<BR>
doctor role:  "doctor1","doctor1"<BR>
user role:  "user1","user1"<BR>
user role:  "user2","user2"<BR>

<h2>PAGE STRUCTURE</h2>
Login view<BR>
Device view shows device list  (admin,doctor,operator)<BR>
User view shows user list (admin,doctor)<BR>
Session view shows session list (admin,doctor,operator,user)<BR>
Session detail shows EDA,HR,Temperature, Accelerometers charts.(admin,doctor,operator,user)<BR>

<h2>FRAMEWORK AND PLATFORMS</h2><BR>
angularjs, bootstrap, highchart, jquery

<h1>INSTALLATION</h1>
Prerequisites: MySQL, Apache, php (WAMP or LAMP stack)

Copy the directory empaticaAssignment under an Apache location.<BR>
Create a new schema on MYSql.<BR>
Rename "example.env to" ".env".<BR>
In ".env" set the database parameters with the created schema and your mysql instance user and password<BR>
Execute the script "db.sql" for populating schema with tables and data<BR>
