# Custom MVC Test


## Setup

- Setup the Vhost in your vhost file of the apache server.

 - Add vhost entry and set the Alias to:

    `trade.local`

 - Set Alias in host file [if required]:
 
	`trade.local`
- Find database in db_backup folder and import. verify crdentials in: 
    
    `app/models/DBConfig.php`

## API CALLS

#### Get All Addresses
- Method: GET
- API URL : http://trade.local/addresses/

#### Insert Address
- Method: POST
- API URL : http://trade.local/addresses/
- Parameters : LABEL, STREET, HOUSENUMBER, POSTALCODE, CITY, COUNTRY

#### Get Single Record
- Method: GET
- API URL : http://trade.local/addresses/{addressId}/
- Parameters : id

#### Update Address
- Method: PUT
- API URL : http://trade.local/addresses/
- Parameters : id, LABEL, STREET, HOUSENUMBER, POSTALCODE, CITY, COUNTRY
- Note: id is required. Atleast one paramerter is required to update otherthan id

## Contact Information
 - Phone : (+971) 50 549 3809
 - Email: mohammadshahbax@gmail.com
 - Linkedin: https://ae.linkedin.com/in/shahbazch

                                    Happy Coding!!!