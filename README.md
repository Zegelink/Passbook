# Passbook

The website is hosted here http://web.engr.oregonstate.edu/~chencho/CS340/Passbook/

Website Passbook.

This repo is for the website Passbook, but misses the connect.php, which you need to fill your own database connection.

# UPDATE:

I added AES256 encryption to safely store user's password in our database. I lazely used a secretInfo.php which includes the initial vector and key. It will be better to store unique initial vector in the database for each AES256 encryption and let the user define the key as a second step verification.
