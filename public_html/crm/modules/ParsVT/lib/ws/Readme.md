<p style="text-align: left; direction: ltr">

# ParsVT Restful API Version 1

ParsVT Restful API allow to communicate with your CRM using a REST API.

## Features

- Create, Retrieve, Update and Delete an entity (CRUD)
- Retrieve a list of entities using pagination
- Add criteria to retrieve a specific list of entities
- Get PickLists values and dependencies
- Upload Documents
- Manage Inventory Modules via Webservice


## Use

You can easily communicate with your CRM using the REST protocol.

**GET:** Authentificate an user / Retrieve an entity or a list of entities / Retrieve PickList values

**POST:** Add an entity

**PUT:** Update an entity

**DELETE:** Remove an entity


## Download Example code in PHP language

To use code sample in PHP language just download the compressed file that contains the web service client library.
[![Downloads](layouts/v7/modules/ParsVT/images/download.png)](index.php?module=ParsVT&view=Misc&downloadWebService=true)

### Authentification

To communicate with your CRM you must be authentificated.

There are 2 solutions to login an user:

1. __With login and password__

```
http://yourcrm.com/modules/ParsVT/ws/auth/LOGIN/PASSWORD

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Auth&login=LOGIN&password=PASSWORD
```

*Replace LOGIN and PASSWORD by your credentials.*


2. __With access Key__

```
http://yourcrm.com/modules/ParsVT/ws/auth/USER_ACCESS_KEY

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Auth&key=USER_ACCESS_KEY
```

*Replace USER_ACCESS_KEY by the user's access key auto-generated by Vtiger.*

![User's Access Key](layouts/v7/modules/ParsVT/images/accesskey.png "User's acess key")


**Result:**

```
{"success":true,"result":"f7171f3d8e13326762a45641c2dd1e39"}

//Token: f7171f3d8e13326762a45641c2dd1e39
```

You must use the generated token in your other calls.

*N.B: With this autentification method the Vtiger ACL are respected.*

### Retrieve data (GET)

We must use the generated token for all calls.
In the following examples we will use the Accounts module, but you can use RestfulApi with all Vtiger modules.

#### Get entities list

```
http://yourcrm.com/modules/ParsVT/ws/Accounts/f7171f3d8e13326762a45641c2dd1e39

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&token=f7171f3d8e13326762a45641c2dd1e39
```

Result:

```
{"success":true,"result":[{"accountname":"MEDIA 3+","account_no":"ACC1","phone":"","website":"","fax":"","tickersymbol":"","otherphone":"","account_id":"0","email1":"","employees":"0","email2":"","ownership":"","rating":"","industry":"","siccode":"","accounttype":"","annual_revenue":"0.00000000","emailoptout":"0","notify_owner":"0","assigned_user_id":"1","createdtime":"2016-10-28 14:40:37","modifiedtime":"2017-09-04 09:29:15","modifiedby":"1","bill_street":"34 all\u00e9e des Fr\u00eanes","ship_street":"34 all\u00e9e des Fr\u00eanes","bill_city":"Champs sur Marne","ship_city":"Champs sur Marne","bill_state":"","ship_state":"","bill_code":"77420","ship_code":"77420","bill_country":"France","ship_country":"France","bill_pobox":"","ship_pobox":"","description":"","campaignrelstatus":"","isconvertedfromlead":"0","record_id":"3","record_module":"Accounts","api_date_now":"2017-09-04 09:29:22"},{"accountname":"ParsVT","account_no":"ACC2","phone":"","website":"www.parsvt.com","fax":"","tickersymbol":"","otherphone":"","account_id":"0","email1":"","employees":"0","email2":"","ownership":"","rating":"","industry":"","siccode":"","accounttype":"","annual_revenue":"0.00000000","emailoptout":"0","notify_owner":"0","assigned_user_id":"1","createdtime":"2017-09-04 09:28:27","modifiedtime":"2017-09-04 09:28:27","modifiedby":"1","bill_street":"","ship_street":"","bill_city":"","ship_city":"","bill_state":"","ship_state":"","bill_code":"","ship_code":"","bill_country":"","ship_country":"","bill_pobox":"","ship_pobox":"","description":"","campaignrelstatus":"","isconvertedfromlead":"0","record_id":"24","record_module":"Accounts","api_date_now":"2017-09-04 09:29:22"}]}
```

#### Get entities list with pagination

You can manage pagination through the API. By default only the 100 first entities are returned.

You can use ```start```, ```length```, and ```order```params to manage the pagination.

```
http://yourcrm.com/modules/ParsVT/ws/Accounts/start/0/length/2/order/vtiger_account.accountname%20DESC/f7171f3d8e13326762a45641c2dd1e39

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&start=0&length=2&order=vtiger_account.accountname%20DESC&token=f7171f3d8e13326762a45641c2dd1e39
```

Result:

```
{"success":true,"result":[{"accountname":"ParsVT","account_no":"ACC2","phone":"","website":"www.parsvt.com","fax":"","tickersymbol":"","otherphone":"","account_id":"0","email1":"","employees":"0","email2":"","ownership":"","rating":"","industry":"","siccode":"","accounttype":"","annual_revenue":"0.00000000","emailoptout":"0","notify_owner":"0","assigned_user_id":"1","createdtime":"2017-09-04 09:28:27","modifiedtime":"2017-09-04 09:28:27","modifiedby":"1","bill_street":"","ship_street":"","bill_city":"","ship_city":"","bill_state":"","ship_state":"","bill_code":"","ship_code":"","bill_country":"","ship_country":"","bill_pobox":"","ship_pobox":"","description":"","campaignrelstatus":"","isconvertedfromlead":"0","record_id":"24","record_module":"Accounts","api_date_now":"2017-09-04 10:14:38"},{"accountname":"MEDIA 3+","account_no":"ACC1","phone":"","website":"","fax":"","tickersymbol":"","otherphone":"","account_id":"0","email1":"","employees":"0","email2":"","ownership":"","rating":"","industry":"","siccode":"","accounttype":"","annual_revenue":"0.00000000","emailoptout":"0","notify_owner":"0","assigned_user_id":"1","createdtime":"2016-10-28 14:40:37","modifiedtime":"2017-09-04 09:29:15","modifiedby":"1","bill_street":"34 all\u00e9e des Fr\u00eanes","ship_street":"34 all\u00e9e des Fr\u00eanes","bill_city":"Champs sur Marne","ship_city":"Champs sur Marne","bill_state":"","ship_state":"","bill_code":"77420","ship_code":"77420","bill_country":"France","ship_country":"France","bill_pobox":"","ship_pobox":"","description":"","campaignrelstatus":"","isconvertedfromlead":"0","record_id":"3","record_module":"Accounts","api_date_now":"2017-09-04 10:14:38"}]}
```

#### Search entities list

Add criteria to the SQL query. You can concatenate several criteria with a semicolon.

One criterium pattern : ```table.column:value```

Several criteria pattern : ```table.column1:value1;table.column2:value2;...;table.columnN:valueN```

```
http://yourcrm.com/modules/ParsVT/ws/Accounts/criteria/vtiger_account.accountname:ParsVT;vtiger_account.website:www.parsvt.com/f7171f3d8e13326762a45641c2dd1e39

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&criteria=vtiger_account.accountname:ParsVT;vtiger_account.website:www.parsvt.com&token=f7171f3d8e13326762a45641c2dd1e39
```

Result:

```
{"success":true,"result":[{"accountname":"ParsVT","account_no":"ACC2","phone":"","website":"www.parsvt.com","fax":"","tickersymbol":"","otherphone":"","account_id":"0","email1":"","employees":"0","email2":"","ownership":"","rating":"","industry":"","siccode":"","accounttype":"","annual_revenue":"0.00000000","emailoptout":"0","notify_owner":"0","assigned_user_id":"1","createdtime":"2017-09-04 09:28:27","modifiedtime":"2017-09-04 09:28:27","modifiedby":"1","bill_street":"","ship_street":"","bill_city":"","ship_city":"","bill_state":"","ship_state":"","bill_code":"","ship_code":"","bill_country":"","ship_country":"","bill_pobox":"","ship_pobox":"","description":"","campaignrelstatus":"","isconvertedfromlead":"0","record_id":"24","record_module":"Accounts","api_date_now":"2017-09-04 09:47:16"}]}
```

#### Retrieve entity by ID

In the following example we retrieve the account with ID = 3.

```
http://yourcrm.com/modules/ParsVT/ws/Accounts/3/f7171f3d8e13326762a45641c2dd1e39

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&id=3&token=f7171f3d8e13326762a45641c2dd1e39
```

Result:

```
{"success":true,"result":{"accountname":"MEDIA 3+","account_no":"ACC1","phone":"","website":"","fax":"","tickersymbol":"","otherphone":"","account_id":"0","email1":"","employees":"0","email2":"","ownership":"","rating":"","industry":"","siccode":"","accounttype":"","annual_revenue":"0.00000000","emailoptout":"0","notify_owner":"0","assigned_user_id":"1","createdtime":"2016-10-28 14:40:37","modifiedtime":"2017-09-04 09:29:15","modifiedby":"1","bill_street":"34 all\u00e9e des Fr\u00eanes","ship_street":"34 all\u00e9e des Fr\u00eanes","bill_city":"Champs sur Marne","ship_city":"Champs sur Marne","bill_state":"","ship_state":"","bill_code":"77420","ship_code":"77420","bill_country":"France","ship_country":"France","bill_pobox":"","ship_pobox":"","description":"","campaignrelstatus":"","isconvertedfromlead":"0","record_id":"3","record_module":"Accounts","api_date_now":"2017-09-04 09:53:04"}}
```

#### Retrieve PickList values

You can retrieve the values from a PickList of a module.
Simply specify the module and the PickList fieldname.


```
http://yourcrm.com/modules/ParsVT/ws/Accounts/picklist/rating/f7171f3d8e13326762a45641c2dd1e39

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&picklist=rating&token=f7171f3d8e13326762a45641c2dd1e39
```

Result:

```
{"success":true,"result":{"values":{"Acquired":"Acquired","Active":"Actif","Market Failed":"Market Failed","Project Cancelled":"Project Cancelled","Shutdown":"Shutdown"}}}
```

You can also retrieve PickList dependencies if exists. Simply add ```&picklistdep=1``` param

```
http://yourcrm.com/modules/ParsVT/ws/Accounts/picklist/rating/picklistdep/1/f7171f3d8e13326762a45641c2dd1e39

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&picklist=rating&picklistdep=1&token=f7171f3d8e13326762a45641c2dd1e39
```

Result:

```
{"success":true,"result":{"values":{"Acquired":"Acquired","Active":"Actif","Market Failed":"Market Failed","Project Cancelled":"Project Cancelled","Shutdown":"Shutdown"},"dependencies":{"Acquired":{"accounttype":["Customer","Integrator","Investor","Partner","Press","Prospect","Reseller","Other"]},"__DEFAULT__":{"accounttype":["Analyst","Competitor","Customer","Integrator","Investor","Partner","Press","Prospect","Reseller","Other"]},"Active":{"accounttype":["Analyst","Competitor","Investor","Partner","Press","Prospect","Reseller","Other"]},"Market Failed":{"accounttype":["Analyst","Competitor","Customer","Integrator","Press","Prospect","Reseller","Other"]},"Project Cancelled":{"accounttype":["Analyst","Competitor","Customer","Integrator","Investor","Partner","Reseller","Other"]},"Shutdown":{"accounttype":["Analyst","Competitor","Customer","Integrator","Investor","Partner","Press","Prospect"]}}}}
```

### Add entity (POST)

We must use the generated token for all calls.
In the following examples we will use the Accounts module, but you can use RestfulApi with all Vtiger modules.

To create a new entity you must at least specify the mandatory fields of the module. It is not mandatory to add all other fields.

To specify a field you must use its fieldname (you can find it in vtiger_field table).

```
URL:

http://localhost/vtiger6.5/modules/ParsVT/ws/Accounts/f7171f3d8e13326762a45641c2dd1e39

or 

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&token=f7171f3d8e13326762a45641c2dd1e39

Data to post:

accountname=ParsVT&email1=parsvtiger@gmail.com&phone=+989138086200&bill_street=100 street beta test\r\nBat. B&bill_code=34000&bill_city=Montpellier&bill_country=France
```

Result:
```
{"success": true,"result": 25}

//25 is the ID of the new created entity
```

### Update entity (PUT or POST)

We must use the generated token for all calls.
In the following examples we will use the Accounts module, but you can use RestfulApi with all Vtiger modules.

To update an entity you must specify its ID and the fields values you want to update.

To specify a field you must use its fieldname (you can find it in vtiger_field table).

```
URL:

http://localhost/vtiger6.5/modules/ParsVT/ws/Accounts/25/f7171f3d8e13326762a45641c2dd1e39

or 

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&id=25&token=f7171f3d8e13326762a45641c2dd1e39

Data to post:

accountname=ParsVT&email1=ParsVT@gmail.com
```

Result:
```
{"success": true,"result": 25}

//25 is the ID of the updated entity
```

### Delete entity (DELETE)

We must use the generated token for all calls.
In the following examples we will use the Accounts module, but you can use RestfulApi with all Vtiger modules.

To remove an entity you must specify its ID.

```
http://yourcrm.com/modules/ParsVT/ws/Accounts/25/f7171f3d8e13326762a45641c2dd1e39

or

http://yourcrm.com/modules/ParsVT/ws/index.php?module=Accounts&id=25&token=f7171f3d8e13326762a45641c2dd1e39
```

Result:

```
{"success": true,"result": true}
```
</p>