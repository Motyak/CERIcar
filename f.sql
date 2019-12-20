create or replace function rechercherVoyages_demo(id_depart jabaianb.trajet.depart%type,id_arrivee jabaianb.trajet.arrivee%type,nb_places integer,heure_depart integer) 
    returns table(id_proposition_voyage integer,id_voyage integer,corresp integer) as $$
-- declare
--     tmp integer;
begin
    -- creation de la table temporaire avec ses colonnes
    create temp table voyages_tmp(id_proposition_voyage integer,id_voyage integer,corresp integer);
    -- recuperation d'infos a partir des tables persistantes
    -- select id into tmp from jabaianb.voyage where tarif=123;
    -- insertion d'enregistrements dans la table temporaire
    insert into voyages_tmp values
        (1,21,null),
        (2,29,32),
        (2,32,null),
        (3,24,25),
        (3,25,null);
    -- retour de la table avant de la drop
    return query
        select * from voyages_tmp;
    drop table voyages_tmp;
    return;
end;

$$language plpgsql;

create or replace function rechercherVoyages_rec(p_depart jabaianb.trajet.depart%type,p_arrivee jabaianb.trajet.arrivee%type,p_nbplaces integer,p_heuredepart integer) 
    returns void as $$
declare
    v_const_arrivee jabaianb.trajet.arrivee%type;
    v_id_prop integer;
    v_branche integer[];
    res record;
    curseur REFCURSOR;
begin
    -- recupere la valeur de l'id proposition precedent
    select id into v_id_prop from prop_tmp limit 1;
    v_id_prop := v_id_prop+1;

    -- recupere la valeur de la constante ville arrivee
    select arrivee into v_const_arrivee from const_arrivee_tmp limit 1;

    open curseur for (select voyage.id,arrivee,distance
		from jabaianb.voyage 
		inner join jabaianb.trajet
        on voyage.trajet=trajet.id
		where depart=p_depart and nbplace>=p_nbplaces and heuredepart>=p_heuredepart
		);
	loop
		fetch curseur into res;

        -- dans le cas d'une dead end
		-- exit when not found;
        if not found then
            -- clear la branche
            delete from branche_tmp;

            exit;
        end if;

        -- dans le cas ou on a trouvé une solution (ensemble de voyages menant vers arrivee)
		if res.arrivee=v_const_arrivee then
            -- ajout de res.id dans la branche
            insert into branche_tmp values (res.id);
            -- ajout de la branche dans la table tmp
            v_branche := array(select id_voyage from branche_tmp);
            for i in 0 .. array_length(v_branche,1)-1 -- i=0 ou i=1 ?
            loop
                raise notice '%',v_branche[i]; -- debug
                -- -- si dernier voyage de la branche..
                -- if(i = array_length(v_branche,1)-1) then
                --     insert into voyages_tmp values(v_id_prop,v_branche[i],null);
                -- else
                --     insert into voyages_tmp values(v_id_prop,v_branche[i],v_branche[i+1]);
                -- end if;
            end loop;

            -- sauvegarde de l'id de proposition
            delete from prop_tmp; insert into prop_tmp values (v_id_prop);
            -- clear la branche
            delete from branche_tmp;
            
        -- dans le cas ou on a potentiellement une solution
        else
            -- ajout de res.id dans la branche
            insert into branche_tmp values (res.id);
            -- la recursivité
            -- perform rechercherVoyages_rec(res.arrivee,p_arrivee,p_nbplaces,p_heuredepart+CEIL(res.distance/60));
            perform rechercherVoyages_rec(res.arrivee,p_arrivee,p_nbplaces,p_heuredepart+res.distance/60);
        end if;
	end loop;
	close curseur;
    return;
end;

$$language plpgsql;

create or replace function rechercherVoyages(p_depart jabaianb.trajet.depart%type,p_arrivee jabaianb.trajet.arrivee%type,p_nbplaces integer,p_heuredepart integer) 
    returns table(id_proposition_voyage integer,id_voyage integer,corresp integer) as $$
-- declare
--     tmp integer;
begin
    -- creation de la table temporaire pour les resultats
    create temp table voyages_tmp(id_proposition_voyage integer,id_voyage integer,corresp integer);

    -- creation table tmp branche
    create temp table branche_tmp(id_voyage integer);

    -- creation table tmp id proposition, valeur de depart = 0
    create temp table prop_tmp(id integer);
    insert into prop_tmp values (0);

    -- creation table tmp villearrivee, valeur constante = p_arrivee
    create temp table const_arrivee_tmp(arrivee varchar(25));
    insert into const_arrivee_tmp values (p_arrivee);

    -- insertion d'enregistrements dans la table temporaire
    perform rechercherVoyages_rec(p_depart,p_arrivee,p_nbplaces,p_heuredepart);
    
    -- drop des tables tmp sauf table resultat
    drop table branche_tmp;
    drop table prop_tmp;
    drop table const_arrivee_tmp;

    -- retour de la table avant de la drop
    return query
        select * from voyages_tmp;
    drop table voyages_tmp;
    return;
end;

$$language plpgsql;

-- scenario : on veut aller de Paris a Marseille, 2 personnes, depart a minuit
-- select * from rechercherVoyages_demo('Paris','Marseille',2,0);
select * from rechercherVoyages('Paris','Marseille',2,0);

drop function rechercherVoyages_demo(jabaianb.trajet.depart%type,jabaianb.trajet.arrivee%type,integer,integer);
drop function rechercherVoyages(p_depart jabaianb.trajet.depart%type,p_arrivee jabaianb.trajet.arrivee%type,p_nbplaces integer,p_heuredepart integer);
drop function rechercherVoyages_rec(p_depart jabaianb.trajet.depart%type,p_arrivee jabaianb.trajet.arrivee%type,p_nbplaces integer,p_heuredepart integer);