Installation Instructions:
Run cp .env.example .env file to copy example file to .env
Then edit your .env file with DB credentials 
Run composer install command
Run php artisan migrate --seed command.
Run php artisan key:generate command.

run php artisan serve
visit your localhost:8080

Username: admin@admin.com
Password: password


Normalised Entities (PK - Primary Key, FK -Foreign Key)

Donor	
id	PK
name	
address	
	
	
	
Fund	
id	PK
name	
Description	
	
	
	
Country	
id	PK
name	
code	
	
	
	
Organisation	
id	PK
name	
Description	
	
	
Theme	
id	PK
name	
description	
	
	
Project	
id	
title	
paas_code	
approval_status	
fund_id	FK
pag_value	
start_date	
end_date	
lead_organisation_id	FK
	
	
donors_projects	
id	
donor_id	FK
project_id	FK
	
	
projects_themes	
id	
project_id	FK
theme_id	FK
	
	
countries_projects	
id	
country_id	FK
project_id	FK
