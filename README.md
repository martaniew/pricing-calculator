# pricing-calculator

Projet Batitom
====================


Objectif
--------

Construire un calculateur en-ligne permettant aux clients de Batitom (societe de rénovation) d'obtenir un devis de travaux et créer un compte d'utlisateur pour afficher 
tous les devis créés. 
Du coté de l'administrateur, l'application lui permets de gérer les questions, les options et les éléments de liste prix (ajouter, supprimer, changer, lier les options avec les elements de liste de prix correspondants). 




Organisation des dossiers et fichiers
-------------------------------------

/application							
	/class								
    	TemplatingTools.php
        UserSession.php					
    /controllers			
    /models	
/lib
    Database.php
    Flashbag.php
    Kernel.php
    Router.php    
/www								
    /css						
    /img													
    /js	
    /views			
index.php	

Organisation de la base de données
-------------------------------------

Dans la base de données, les options disponibles dans le calculateur sont liées aux elements de la liste de prix (many to many). Cela permet à l'administateur de gérer le calculater et actualiser de prix facilement.
