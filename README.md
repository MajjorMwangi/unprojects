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
