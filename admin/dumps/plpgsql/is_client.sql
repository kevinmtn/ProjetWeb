create function is_client3(text,text, text, text, text, text, text, text) returns integer
as
'
	declare f_prenom_client alias for $1;
	declare f_nom_client alias for $2;
	declare f_adresse alias for $3;
	declare f_numero alias for $4;
	declare f_telephone alias for $5;
	declare f_email alias for $6;
	declare f_motdepasse alias for $7;
	declare f_login alias for $8;
	declare id integer;
	declare retour integer;
	
begin
	 
	 select into id id_client from client where f_prenom_client = f_prenom_client and f_nom_client = f_nom_client and f_adresse  = f_adresse and f_numero  = f_numero and f_telephone  = f_telephone and f_email  = f_email and f_motdepasse  = f_motdepasse and f_login  = f_login;
	 if not found
	 then
	 	retour = 0;
	else
		retour = 1;
		
	end if;
	
	return retour;

end;

'
language plpgsql;