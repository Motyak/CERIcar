create table trajet(
    id integer not null primary key,
    depart varchar(25),
    arrivee varchar(25),
    distance integer
);

insert into trajet(id,depart,arrivee,distance) values
(2 , 'Angers'        , 'Amiens'        ,      399),
 (85 , 'Amiens'        , 'Bordeaux'      ,      679),
 (116 , 'Bordeaux'      , 'Brest'         ,      634),
  (201 , 'Brest'         , 'Clermond_Fd'   ,      752),
  (327 , 'Paris'         , 'Lille'         ,      223),
  (350 , 'Marseille'     , 'Lyon'          ,      323),
  (355 , 'Paris'         , 'Lyon'          ,      470),
  (377 , 'Lyon'          , 'Marseille'     ,      323),
   (470 , 'Rennes'        , 'Nantes'        ,      106),
   (489 , 'Lyon'          , 'Nice'          ,      480),
   (490 , 'Marseille'     , 'Nice'          ,      197),
   (517 , 'Lyon'          , 'Paris'         ,      470),
   (518 , 'Marseille'     , 'Paris'         ,      793);

--     (29 , 'Amiens'        , 'Angers'        ,      369),
--   (30 , 'Angers'        , 'Angers'        ,        0),

--   (32 , 'Bordeaux'      , 'Angers'        ,      335),
--   (33 , 'Brest'         , 'Angers'        ,      371),

--   (37 , 'Dijon'         , 'Angers'        ,      498),

--   (43 , 'Montpellier'   , 'Angers'        ,      692),

--   (58 , 'Angers'        , 'Biarritz'      ,      518),

--   (63 , 'Cherbourg'     , 'Biarritz'      ,      808),

--   (67 , 'Le Havre'      , 'Biarritz'      ,      800),

--   (85 , 'Amiens'        , 'Bordeaux'      ,      679),
--   (86 , 'Angers'        , 'Bordeaux'      ,      335),
--   (87 , 'Biarritz'      , 'Bordeaux'      ,      183),

--  (113 , 'Amiens'        , 'Brest'         ,      619),
--  (114 , 'Angers'        , 'Brest'         ,      371),

--  (116 , 'Bordeaux'      , 'Brest'         ,      634),

--  (125 , 'Lyon'          , 'Brest'         ,      890),

--  (127 , 'Montpellier'   , 'Brest'         ,     1048),

--  (131 , 'Paris'         , 'Brest'         ,      581),

--  (172 , 'Bordeaux'      , 'Cherbourg'     ,      625),

--  (201 , 'Brest'         , 'Clermond_Fd'   ,      752),

--  (243 , 'Paris'         , 'Dijon'         ,      323),

--  (253 , 'Amiens'        , 'Grenoble'      ,      674),

--  (281 , 'Amiens'        , 'Le Havre'      ,      180),
--  (282 , 'Angers'        , 'Le Havre'      ,      297),

--  (285 , 'Brest'         , 'Le Havre'      ,      468),

--  (290 , 'Grenoble'      , 'Le Havre'      ,      776),

--  (292 , 'Lille'         , 'Le Havre'      ,      284),

--  (294 , 'Marseille'     , 'Le Havre'      ,      980),

--  (299 , 'Paris'         , 'Le Havre'      ,      211),

--  (308 , 'Vichy'         , 'Le Havre'      ,      547),

--  (322 , 'Marseille'     , 'Lille'         ,      991),

--  (327 , 'Paris'         , 'Lille'         ,      223),

--  (336 , 'Vichy'         , 'Lille'         ,      574),

--  (341 , 'Brest'         , 'Lyon'          ,      890),

--  (349 , 'Lyon'          , 'Lyon'          ,        0),
--  (350 , 'Marseille'     , 'Lyon'          ,      323),

--  (354 , 'Nice'          , 'Lyon'          ,      480),
--  (355 , 'Paris'         , 'Lyon'          ,      470),

--  (369 , 'Brest'         , 'Marseille'     ,     1194),

--  (377 , 'Lyon'          , 'Marseille'     ,      323),

--  (382 , 'Nice'          , 'Marseille'     ,      197),
--  (383 , 'Paris'         , 'Marseille'     ,      793),

--  (404 , 'Lille'         , 'Montpellier'   ,      961),

--  (406 , 'Marseille'     , 'Montpellier'   ,      163),

--  (410 , 'Nice'          , 'Montpellier'   ,      345),

--  (418 , 'Toulouse'      , 'Montpellier'   ,      249),

--  (425 , 'Brest'         , 'Nancy'         ,      886),

--  (464 , 'Nancy'         , 'Nantes'        ,      692),

--  (470 , 'Rennes'        , 'Nantes'        ,      106),

--  (489 , 'Lyon'          , 'Nice'          ,      480),
--  (490 , 'Marseille'     , 'Nice'          ,      197),

--  (495 , 'Paris'         , 'Nice'          ,      950),

--  (509 , 'Brest'         , 'Paris'         ,      581),

--  (517 , 'Lyon'          , 'Paris'         ,      470),
--  (518 , 'Marseille'     , 'Paris'         ,      793),

--  (547 , 'Montpellier'   , 'Perpignan'     ,      163),

--  (551 , 'Paris'         , 'Perpignan'     ,      926),

--  (677 , 'Brest'         , 'Strasbourg'    ,     1026),

--  (780 , 'Saint-Etienne', 'Vichy'         ,      145),

--  (786 , 'Avignon'       , 'Marseille'     ,      100);


create table voyage(
    id integer not null primary key,
    conducteur integer,
    trajet integer references trajet(id),
    tarif integer,
    nbplace integer,
    heuredepart integer,
    contraintes varchar(500)
);

insert into voyage(id,conducteur,trajet,tarif,nbplace,heuredepart,contraintes) values
   (1 ,          6 ,      2 ,         50 ,       0 ,          10 ,null),
   (2 ,          4 ,      2 ,        100 ,       0 ,          11 , 'nosmoking'),
   (3 ,          3 ,    355 ,         80 ,       1 ,           8 ,null),
   (4 ,          3 ,    489 ,         40 ,       0 ,          14 ,null),
   (5 ,          3 ,    377 ,         40 ,       0 ,          15 ,null),
   (6 ,          3 ,    490 ,         20 ,       0 ,          20 ,null),
   (7 ,          1 ,    355 ,         41 ,       0 ,           7 , 'nosmoking,noanimals,noguns'),
   (8 ,          3 ,      2 ,         50 ,       0 ,          23 ,null),
   (9 ,          3 ,    350 ,        100 ,       1 ,          11 ,null),
  (10 ,          3 ,    470 ,        100 ,       3 ,          18 ,null),
  (11 ,          3 ,    327 ,        100 ,       0 ,          23 ,null),
  (12 ,          3 ,    517 ,        100 ,       0 ,          18 ,null),
  (13 ,          3 ,    518 ,        100 ,       0 ,          18 , 'Inter'),
  (14 ,          3 ,     85 ,        200 ,       3 ,           1 ,null),
  (15 ,          4 ,    116 ,        200 ,       1 ,          11 ,null),
  (16 ,          5 ,    201 ,        200 ,       3 ,          23 ,null),
  (17 ,          4 ,    350 ,        200 ,       0 ,          11 ,null),
  (18 ,          4 ,    517 ,        200 ,       0 ,          11 ,null),
  (19 ,          4 ,    355 ,        200 ,       1 ,          11 ,null),
  (20 ,          4 ,    489 ,        200 ,       1 ,          11 ,null),
  (21 ,          9 ,    355 ,         41 ,       0 ,           0 , 'nosmoking,noanimals,noguns'),
  (22 ,          9 ,    355 ,         41 ,       2 ,          14 , 'nosmoking,noanimals,noguns'),
  (23 ,          9 ,    355 ,         99 ,       5 ,          23 , 'nosmoking,noanimals,noguns'),
  (24 ,          9 ,    355 ,         41 ,       0 ,           0 , 'nosmoking,noanimals,noguns'),
  (25 ,          9 ,    355 ,         41 ,       2 ,           9 , 'nosmoking,noanimals,noguns'),
  (26 ,          9 ,    355 ,         41 ,       3 ,          15 , 'nosmoking,noanimals,noguns'),
  (27 ,          9 ,    355 ,         41 ,       3 ,          19 , 'nosmoking,noanimals,noguns'),
  (28 ,          9 ,    355 ,         55 ,       2 ,          23 , 'nosmoking,noguns'),
  (29 ,          9 ,    355 ,         99 ,       1 ,           0 , 'nosmoking,noanimals,noguns'),
  (30 ,          9 ,    355 ,        123 ,       2 ,           9 , 'nosmoking,noguns'),
  (31 ,          9 ,    355 ,        148 ,       0 ,          12 , 'noanimals,noguns'),
  (32 ,          9 ,    355 ,         41 ,       3 ,           9 ,null),
  (33 ,          9 ,    355 ,         48 ,       4 ,           0 , 'nosmoking'),
  (34 ,          9 ,    355 ,         41 ,       1 ,           0 ,null),
  (37 ,          9 ,    355 ,         41 ,       2 ,           0 ,null),
  (38 ,          9 ,    355 ,         41 ,       5 ,           0 , 'noanimals'),
  (39 ,          9 ,    355 ,         41 ,       5 ,           8 ,null),
  (40 ,          9 ,    355 ,         41 ,       3 ,          14 ,null),
  (41 ,          9 ,    355 ,        123 ,       3 ,           0 , 'nosmoking,noanimals,noguns');




  
