## Backend Documentation

- To create tables and establish relationships, I utilized Laravel Migrations.
- I used Eloquent to directly interact with the database.
- To segregate logic and model persistence, I employed the Repository Pattern.
- For validating entry points, I utilized Requests.
- To define the structure of the returned API, I employed Laravel Resources.


## API Documentation

    To test Our Api, you can use Postman and copy/paste this code : 

- [Get Customers] : Method Get http://fastsoc-backend.test/api .
- [Add Customers] : Method Post http://fastsoc-backend.test/api/customers, body :  
    {
            "siret": "12321",
            "siren": "22",
            "legal_name": "dsfqsdfqdsf"
    }
- [Update Customers] : Method Put http://fastsoc-backend.test/api/customers/{id}  with body :
    {
            "siret": "xxx",
            "siren": "xxx",
            "legal_name": "xxxx"
    }


- [get Customer] : Method Put http://fastsoc-backend.test/api/customers/{id}  

- [delete Customer] : Method delete http://fastsoc-backend.test/api/customers/{id} 



