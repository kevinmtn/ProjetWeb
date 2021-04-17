--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

-- Started on 2021-04-02 12:08:04

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA public;


--
-- TOC entry 3066 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 215 (class 1255 OID 17399)
-- Name: is_admin(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.is_admin(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_login alias for $1;
	declare f_password alias for $2;
	declare id integer;
	declare retour integer;

begin

	 select into id id_admin from admin where f_login = f_login and password = f_password;
	 if not found
	 then
	 	retour = 0;
	else
		retour = 1;

	end if;

	return retour;

end;

';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 208 (class 1259 OID 17348)
-- Name: admin; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.admin (
    id_admin integer NOT NULL,
    login text,
    password text
);


--
-- TOC entry 209 (class 1259 OID 17356)
-- Name: admin_id_admin_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.admin_id_admin_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3067 (class 0 OID 0)
-- Dependencies: 209
-- Name: admin_id_admin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.admin_id_admin_seq OWNED BY public.admin.id_admin;


--
-- TOC entry 202 (class 1259 OID 17306)
-- Name: categorie; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.categorie (
    id_cat integer NOT NULL,
    nom_cat text NOT NULL,
    image text
);


--
-- TOC entry 203 (class 1259 OID 17314)
-- Name: categorie_id_cat_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.categorie_id_cat_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3068 (class 0 OID 0)
-- Dependencies: 203
-- Name: categorie_id_cat_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.categorie_id_cat_seq OWNED BY public.categorie.id_cat;


--
-- TOC entry 200 (class 1259 OID 17296)
-- Name: client; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.client (
    id_client integer NOT NULL,
    nom_client text NOT NULL,
    prenom_client text NOT NULL,
    adresse text NOT NULL,
    numero text NOT NULL,
    telephone text NOT NULL,
    email text NOT NULL,
    motdepasse text NOT NULL,
    login text NOT NULL
);


--
-- TOC entry 201 (class 1259 OID 17304)
-- Name: client_id_client_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.client_id_client_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3069 (class 0 OID 0)
-- Dependencies: 201
-- Name: client_id_client_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.client_id_client_seq OWNED BY public.client.id_client;


--
-- TOC entry 206 (class 1259 OID 17331)
-- Name: commande; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.commande (
    id_commande integer NOT NULL,
    prix real NOT NULL,
    quantite integer NOT NULL,
    id_client integer NOT NULL,
    id_produit integer,
    date_livraison date,
    date_commande date
);


--
-- TOC entry 207 (class 1259 OID 17346)
-- Name: commande_id_commande_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.commande_id_commande_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3070 (class 0 OID 0)
-- Dependencies: 207
-- Name: commande_id_commande_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.commande_id_commande_seq OWNED BY public.commande.id_commande;


--
-- TOC entry 210 (class 1259 OID 17358)
-- Name: commentaire; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.commentaire (
    id_commentaire integer NOT NULL,
    commentaire text,
    id_client integer NOT NULL,
    id_produit integer,
    id_commande integer
);


--
-- TOC entry 211 (class 1259 OID 17381)
-- Name: commentaire_id_commentaire_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.commentaire_id_commentaire_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3071 (class 0 OID 0)
-- Dependencies: 211
-- Name: commentaire_id_commentaire_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.commentaire_id_commentaire_seq OWNED BY public.commentaire.id_commentaire;


--
-- TOC entry 204 (class 1259 OID 17316)
-- Name: produit; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.produit (
    id_produit integer NOT NULL,
    nom_produit text NOT NULL,
    photo text NOT NULL,
    prix real NOT NULL,
    stock integer NOT NULL,
    description text NOT NULL,
    id_cat integer
);


--
-- TOC entry 205 (class 1259 OID 17329)
-- Name: produit_id_produit_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.produit_id_produit_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3072 (class 0 OID 0)
-- Dependencies: 205
-- Name: produit_id_produit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.produit_id_produit_seq OWNED BY public.produit.id_produit;


--
-- TOC entry 212 (class 1259 OID 17383)
-- Name: vue_categorie; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_categorie AS
 SELECT produit.id_produit,
    produit.nom_produit,
    produit.photo,
    produit.prix,
    produit.stock,
    produit.description,
    categorie.id_cat,
    categorie.nom_cat,
    categorie.image
   FROM public.produit,
    public.categorie
  WHERE (produit.id_produit = categorie.id_cat);


--
-- TOC entry 213 (class 1259 OID 17387)
-- Name: vue_categorie2; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_categorie2 AS
 SELECT produit.id_produit,
    produit.nom_produit,
    produit.photo,
    produit.prix,
    produit.stock,
    produit.description,
    categorie.id_cat,
    categorie.nom_cat
   FROM public.produit,
    public.categorie
  WHERE (produit.id_produit = categorie.id_cat);


--
-- TOC entry 214 (class 1259 OID 17391)
-- Name: vue_categorie3; Type: VIEW; Schema: public; Owner: -
--

CREATE VIEW public.vue_categorie3 AS
 SELECT produit.id_produit,
    produit.nom_produit,
    produit.photo,
    produit.prix,
    produit.stock,
    produit.description,
    categorie.id_cat
   FROM public.produit,
    public.categorie
  WHERE (produit.id_cat = categorie.id_cat);


--
-- TOC entry 3057 (class 0 OID 17348)
-- Dependencies: 208
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 3051 (class 0 OID 17306)
-- Dependencies: 202
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.categorie (id_cat, nom_cat, image) VALUES (1, 'Tablette', 'tablette1.png');
INSERT INTO public.categorie (id_cat, nom_cat, image) VALUES (2, 'Mignonnette', 'migno1.png');
INSERT INTO public.categorie (id_cat, nom_cat, image) VALUES (3, 'Bâton', 'baton1.png');


--
-- TOC entry 3049 (class 0 OID 17296)
-- Dependencies: 200
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 3055 (class 0 OID 17331)
-- Dependencies: 206
-- Data for Name: commande; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 3059 (class 0 OID 17358)
-- Dependencies: 210
-- Data for Name: commentaire; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- TOC entry 3053 (class 0 OID 17316)
-- Dependencies: 204
-- Data for Name: produit; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (1, 'Tablette chocolat noir', 'tablette1.png', 2.99, 110, 'L'' original au chocolat noir', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (2, 'Tablette chocolat au lait', 'tablette2.png', 2.99, 60, 'L'' original au chocolat au lait ', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (12, 'Bâton banane', 'baton4.png', 2.99, 80, 'Bâton au goût banane', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (16, 'Mignonnette collection', 'migno5.png', 4.99, 67, 'Découvrez les tous dans cette boîte spéciale', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (17, 'L original Noir de Noir', 'tablette5.png', 4.5, 39, 'L'' original noir de noir', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (5, 'Mignonnette au chocolat noir', 'migno2.png', 3.99, 70, '24 Mignonnettes au chocolat noir de noir', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (10, 'Bâton au lait', 'baton2.png', 2.99, 65, 'Baton au chocolat au lait', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (4, 'Mignonnette au lait', 'migno1.png', 4.99, 74, '24 Mignonnettes au chocolat au lait ', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (15, 'Mignonnette varieté', 'migno6.png', 4.99, 30, '4 goûts différents dans une seule boîte ', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (6, 'Mignonnette gout orange', 'migno3.png', 4.99, 70, '24 Mignonnettes au chocolat pralinés', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (7, 'Mignonnette au chocolat noir 70 %', 'migno4.png', 4.99, 60, '24 Mignonnettes au chocolat noisette', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (9, 'Bâton noir', 'baton1.png', 2.99, 80, 'Bâton au chocolat noir', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (13, 'Bâton vanille', 'baton5.png', 2.5, 60, 'Bâton au gout de la vanille', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (18, 'Chocolat culinaire', 'tablette6.png', 2.5, 35, 'La tablette parfaite pour vos cuissons', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (3, 'Tablette chocolat blanc', 'tablette4.png', 3.5, 70, 'L'' original au chocolat blanc ', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (8, 'Tablette au chocolat noisette', 'tablette3.png', 3.99, 70, 'L''  original au chocolat noisette ', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (11, 'Bâton noisette', 'baton3.png', 2.5, 85, 'Baton au chocolat noisette', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (14, 'Bâton praline', 'baton6.png', 2.5, 72, 'Bâton au gout praliné', 3);


--
-- TOC entry 3073 (class 0 OID 0)
-- Dependencies: 209
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 1, false);


--
-- TOC entry 3074 (class 0 OID 0)
-- Dependencies: 203
-- Name: categorie_id_cat_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.categorie_id_cat_seq', 1, false);


--
-- TOC entry 3075 (class 0 OID 0)
-- Dependencies: 201
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.client_id_client_seq', 1, false);


--
-- TOC entry 3076 (class 0 OID 0)
-- Dependencies: 207
-- Name: commande_id_commande_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.commande_id_commande_seq', 1, false);


--
-- TOC entry 3077 (class 0 OID 0)
-- Dependencies: 211
-- Name: commentaire_id_commentaire_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.commentaire_id_commentaire_seq', 1, false);


--
-- TOC entry 3078 (class 0 OID 0)
-- Dependencies: 205
-- Name: produit_id_produit_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.produit_id_produit_seq', 1, false);


--
-- TOC entry 2907 (class 2606 OID 17355)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 2901 (class 2606 OID 17313)
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (id_cat);


--
-- TOC entry 2899 (class 2606 OID 17303)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- TOC entry 2905 (class 2606 OID 17335)
-- Name: commande commande_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_pkey PRIMARY KEY (id_commande);


--
-- TOC entry 2909 (class 2606 OID 17365)
-- Name: commentaire commentaire_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT commentaire_pkey PRIMARY KEY (id_commentaire);


--
-- TOC entry 2903 (class 2606 OID 17323)
-- Name: produit produit_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_pkey PRIMARY KEY (id_produit);


--
-- TOC entry 2911 (class 2606 OID 17336)
-- Name: commande fk_commande_id_client; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT fk_commande_id_client FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- TOC entry 2912 (class 2606 OID 17341)
-- Name: commande fk_commande_id_produit; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT fk_commande_id_produit FOREIGN KEY (id_produit) REFERENCES public.produit(id_produit);


--
-- TOC entry 2913 (class 2606 OID 17366)
-- Name: commentaire fk_commentaire_id_client; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT fk_commentaire_id_client FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- TOC entry 2915 (class 2606 OID 17376)
-- Name: commentaire fk_commentaire_id_commande; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT fk_commentaire_id_commande FOREIGN KEY (id_commande) REFERENCES public.commande(id_commande);


--
-- TOC entry 2914 (class 2606 OID 17371)
-- Name: commentaire fk_commentaire_id_produit; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT fk_commentaire_id_produit FOREIGN KEY (id_produit) REFERENCES public.produit(id_produit);


--
-- TOC entry 2910 (class 2606 OID 17324)
-- Name: produit produit_id_cat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_id_cat_fkey FOREIGN KEY (id_cat) REFERENCES public.categorie(id_cat);


-- Completed on 2021-04-02 12:08:04

--
-- PostgreSQL database dump complete
--

