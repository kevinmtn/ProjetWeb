--
-- PostgreSQL database dump
--

-- Dumped from database version 13.1
-- Dumped by pg_dump version 13.1

-- Started on 2021-05-06 10:35:57

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
-- TOC entry 3071 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 216 (class 1255 OID 17399)
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


--
-- TOC entry 217 (class 1255 OID 17401)
-- Name: is_client(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.is_client(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_id_client alias for $1;
	declare f_motdepasse alias for $2;
	declare id integer;
	declare retour integer;

begin

	 select into id id_client from client where f_login = f_login and motdepasse = f_motdepasse;
	 if not found
	 then
	 	retour = 0;
	else
		retour = 1;

	end if;

	return retour;

end;
';


--
-- TOC entry 218 (class 1255 OID 17402)
-- Name: is_client2(text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.is_client2(text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
	declare f_id_client alias for $1;
	declare f_motdepasse alias for $2;
	declare id integer;
	declare retour integer;

begin

	 select into id id_client from client where f_login = f_login and motdepasse = f_motdepasse;
	 if not found
	 then
	 	retour = 0;
	else
		retour = 1;

	end if;

	return retour;

end;
';


--
-- TOC entry 219 (class 1255 OID 17404)
-- Name: is_client3(text, text, text, text, text, text, text, text); Type: FUNCTION; Schema: public; Owner: -
--

CREATE FUNCTION public.is_client3(text, text, text, text, text, text, text, text) RETURNS integer
    LANGUAGE plpgsql
    AS '
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
-- TOC entry 3072 (class 0 OID 0)
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
-- TOC entry 3073 (class 0 OID 0)
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
-- TOC entry 3074 (class 0 OID 0)
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
    id_client integer NOT NULL,
    date_livraison date,
    date_commande date,
    id_produit integer
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
-- TOC entry 3075 (class 0 OID 0)
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
    id_commande integer,
    note integer
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
-- TOC entry 3076 (class 0 OID 0)
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
-- TOC entry 3077 (class 0 OID 0)
-- Dependencies: 205
-- Name: produit_id_produit_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.produit_id_produit_seq OWNED BY public.produit.id_produit;


--
-- TOC entry 215 (class 1259 OID 17405)
-- Name: seq_sans_serial; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.seq_sans_serial
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999999996
    CACHE 1;


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
-- TOC entry 3061 (class 0 OID 17348)
-- Dependencies: 208
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.admin (id_admin, login, password) VALUES (1, 'admin', 'admin');
INSERT INTO public.admin (id_admin, login, password) VALUES (2, 'kevin', 'kev');


--
-- TOC entry 3055 (class 0 OID 17306)
-- Dependencies: 202
-- Data for Name: categorie; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.categorie (id_cat, nom_cat, image) VALUES (1, 'Tablette', 'tablette1.png');
INSERT INTO public.categorie (id_cat, nom_cat, image) VALUES (2, 'Mignonnette', 'migno1.png');
INSERT INTO public.categorie (id_cat, nom_cat, image) VALUES (3, 'Bâton', 'baton1.png');


--
-- TOC entry 3053 (class 0 OID 17296)
-- Dependencies: 200
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.client (id_client, nom_client, prenom_client, adresse, numero, telephone, email, motdepasse, login) VALUES (19, 'maton', 'maxime', 'avenue', '11', '0478650388', 'maximematon@condorcet.be', '202cb962ac59075b964b07152d234b70', 'maxime');
INSERT INTO public.client (id_client, nom_client, prenom_client, adresse, numero, telephone, email, motdepasse, login) VALUES (20, 'maton', 'kevin', 'avenue', '11', '0478650388', 'kevinmaton@condorcet.be', '202cb962ac59075b964b07152d234b70', 'test');
INSERT INTO public.client (id_client, nom_client, prenom_client, adresse, numero, telephone, email, motdepasse, login) VALUES (21, 'mtn', 'kev', 'avenue des test', '2', '0455', 'kev@gmail', '698d51a19d8a121ce581499d7b701668', 'kev');
INSERT INTO public.client (id_client, nom_client, prenom_client, adresse, numero, telephone, email, motdepasse, login) VALUES (1, 'maton', 'kevin', 'avenue du test', '111', '04785566655', 'kevinmaton@condorcet.be', '5e36941b3d856737e81516acd45edc50', 'kevin');
INSERT INTO public.client (id_client, nom_client, prenom_client, adresse, numero, telephone, email, motdepasse, login) VALUES (131, 'test', 'testeur', 'Avenue de test', '55', '0478885665', 'testeur@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'test');
INSERT INTO public.client (id_client, nom_client, prenom_client, adresse, numero, telephone, email, motdepasse, login) VALUES (173, 'Leblanc', 'tom', 'avenue des pins', '25', '0458665555', 'tomLeblanc@gmail.com', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'tom');
INSERT INTO public.client (id_client, nom_client, prenom_client, adresse, numero, telephone, email, motdepasse, login) VALUES (195, 'maton', 'lea', 'Avenue du sommet', '8', '0478650389', 'lea@gmail.com', '812b94eb454835665e25797809c1d137', 'lea');


--
-- TOC entry 3059 (class 0 OID 17331)
-- Dependencies: 206
-- Data for Name: commande; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (96, 21, '2021-04-13', '2021-04-08', 4);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (97, 21, '2021-04-13', '2021-04-08', 3);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (98, 21, '2021-04-13', '2021-04-08', 4);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (99, 21, '2021-04-13', '2021-04-08', 3);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (100, 21, '2021-04-13', '2021-04-08', 4);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (101, 21, '2021-04-13', '2021-04-08', 3);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (102, 21, '2021-04-13', '2021-04-08', 4);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (103, 21, '2021-04-13', '2021-04-08', 3);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (104, 21, '2021-04-13', '2021-04-08', 1);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (105, 21, '2021-04-13', '2021-04-08', 1);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (106, 21, '2021-04-13', '2021-04-08', 1);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (107, 21, '2021-04-13', '2021-04-08', 1);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (108, 21, '2021-04-13', '2021-04-08', 18);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (109, 21, '2021-04-13', '2021-04-08', 18);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (111, 1, '2021-04-15', '2021-04-10', 3);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (112, 1, '2021-04-15', '2021-04-10', 3);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (113, 1, '2021-04-15', '2021-04-10', 3);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (114, 1, '2021-04-16', '2021-04-11', 9);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (115, 1, '2021-04-16', '2021-04-11', 7);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (116, 1, '2021-04-16', '2021-04-11', 18);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (117, 1, '2021-04-16', '2021-04-11', 2);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (118, 1, '2021-04-16', '2021-04-11', 2);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (119, 1, '2021-04-16', '2021-04-11', 6);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (120, 19, '2021-04-16', '2021-04-11', 16);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (121, 19, '2021-04-16', '2021-04-11', 2);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (122, 19, '2021-04-16', '2021-04-11', 13);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (123, 19, '2021-04-16', '2021-04-11', 5);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (124, 19, '2021-04-16', '2021-04-11', 15);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (125, 1, '2021-04-16', '2021-04-11', 18);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (126, 1, '2021-04-16', '2021-04-11', 8);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (127, 1, '2021-04-16', '2021-04-11', 7);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (128, 1, '2021-04-17', '2021-04-12', 18);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (129, 1, '2021-04-17', '2021-04-12', 17);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (130, 1, '2021-04-17', '2021-04-12', 12);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (132, 1, '2021-04-19', '2021-04-14', 7);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (133, 1, '2021-04-19', '2021-04-14', 18);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (134, 1, '2021-04-19', '2021-04-14', 10);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (135, 1, '2021-04-19', '2021-04-14', 3);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (136, 1, '2021-04-19', '2021-04-14', 17);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (141, 19, '2021-04-27', '2021-04-22', 12);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (142, 19, '2021-04-27', '2021-04-22', 11);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (183, 19, '2021-05-02', '2021-04-27', 182);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (184, 19, '2021-05-02', '2021-04-27', 181);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (188, 173, '2021-05-08', '2021-05-03', 5);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (189, 173, '2021-05-08', '2021-05-03', 187);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (190, 173, '2021-05-08', '2021-05-03', 12);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (191, 173, '2021-05-08', '2021-05-03', 13);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (193, 173, '2021-05-08', '2021-05-03', 5);
INSERT INTO public.commande (id_commande, id_client, date_livraison, date_commande, id_produit) VALUES (194, 173, '2021-05-08', '2021-05-03', 182);


--
-- TOC entry 3063 (class 0 OID 17358)
-- Dependencies: 210
-- Data for Name: commentaire; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.commentaire (id_commentaire, commentaire, id_client, id_produit, id_commande, note) VALUES (1, 'Chocolat très bon, reçu rapidement', 1, 12, 130, 4);
INSERT INTO public.commentaire (id_commentaire, commentaire, id_client, id_produit, id_commande, note) VALUES (2, 'Mon préféré', 21, 4, 96, 5);
INSERT INTO public.commentaire (id_commentaire, commentaire, id_client, id_produit, id_commande, note) VALUES (138, 'miam', 1, 3, 113, 5);
INSERT INTO public.commentaire (id_commentaire, commentaire, id_client, id_produit, id_commande, note) VALUES (139, 'le meilleur', 19, 13, 122, 4);
INSERT INTO public.commentaire (id_commentaire, commentaire, id_client, id_produit, id_commande, note) VALUES (140, 'bon prix', 19, 15, 124, 4);
INSERT INTO public.commentaire (id_commentaire, commentaire, id_client, id_produit, id_commande, note) VALUES (153, '                délicieux', 19, 11, 142, 5);
INSERT INTO public.commentaire (id_commentaire, commentaire, id_client, id_produit, id_commande, note) VALUES (192, '  Goût assez spécial', 173, 187, 189, 3);


--
-- TOC entry 3057 (class 0 OID 17316)
-- Dependencies: 204
-- Data for Name: produit; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (8, 'Tablette au chocolat noisette', 'tablette3.png', 3.99, 214, 'L''  original au chocolat noisette ', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (15, 'Mignonnette varieté', 'migno6.png', 4.99, 77, '4 goûts différents dans une seule boîte ', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (3, 'Tablette chocolat blanc', 'tablette4.png', 3.49, 105, 'L'' original au chocolat blanc ', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (12, 'Bâton goût banane', 'baton4.png', 2.99, 612, 'Bâton au goût banane', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (199, 'tablette culinaire', 'tablette6.png', 3.99, 82, 'la tablette parfaite pour vos cuissons', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (5, 'Mignonnette au chocolat noir', 'migno2.png', 3.99, 70, '24 Mignonnettes au chocolat noir de noir', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (14, 'Bâton praline', 'baton6.png', 2.49, 55, 'Bâton au gout praliné', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (17, 'L original Noir de Noir', 'tablette5.png', 3.99, 54, 'L'' original noir de noir', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (4, 'Mignonnette au lait', 'migno1.png', 3.99, 74, '24 Mignonnettes au chocolat au lait ', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (9, 'Bâton chocolat noir', 'baton1.png', 2.99, 100, 'Bâton au chocolat noir', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (7, 'Mignonnette  noir 70 %', 'migno4.png', 4.99, 60, '24 Mignonnettes au chocolat noisette', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (13, 'Bâton goût vanille', 'baton5.png', 2.99, 80, 'Bâton au gout de la vanille', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (6, 'Mignonnette gout orange', 'migno3.png', 4.5, 90, '24 Mignonnettes au chocolat pralinés', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (11, 'Bâton gôut noisette', 'baton3.png', 2.49, 41, 'Baton au chocolat noisette', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (10, 'Bâton au lait', 'baton2.png', 2.99, 44, 'Baton au chocolat au lait', 3);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (180, 'Tablette au lait', 'tablette2.png', 3.49, 140, 'L''original au chocolat au lait', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (181, 'Mignonette Bio', 'migno7.png', 3.49, 324, 'Mignonette Bio', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (185, 'Tablette noir', 'tablette1.png', 2.99, 120, 'L''original noir', 1);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (186, 'Mignonette Collection', 'migno5.png', 5.99, 147, 'Gouter les toutes dans ce nouveau format', 2);
INSERT INTO public.produit (id_produit, nom_produit, photo, prix, stock, description, id_cat) VALUES (187, 'Bâton à la pistache', 'baton8.png', 2.99, 87, 'Bâton au goût de la pistache', 3);


--
-- TOC entry 3078 (class 0 OID 0)
-- Dependencies: 209
-- Name: admin_id_admin_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_id_admin_seq', 1, false);


--
-- TOC entry 3079 (class 0 OID 0)
-- Dependencies: 203
-- Name: categorie_id_cat_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.categorie_id_cat_seq', 1, false);


--
-- TOC entry 3080 (class 0 OID 0)
-- Dependencies: 201
-- Name: client_id_client_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.client_id_client_seq', 1, false);


--
-- TOC entry 3081 (class 0 OID 0)
-- Dependencies: 207
-- Name: commande_id_commande_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.commande_id_commande_seq', 1, false);


--
-- TOC entry 3082 (class 0 OID 0)
-- Dependencies: 211
-- Name: commentaire_id_commentaire_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.commentaire_id_commentaire_seq', 1, false);


--
-- TOC entry 3083 (class 0 OID 0)
-- Dependencies: 205
-- Name: produit_id_produit_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.produit_id_produit_seq', 1, false);


--
-- TOC entry 3084 (class 0 OID 0)
-- Dependencies: 215
-- Name: seq_sans_serial; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.seq_sans_serial', 199, true);


--
-- TOC entry 2912 (class 2606 OID 17355)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);


--
-- TOC entry 2906 (class 2606 OID 17313)
-- Name: categorie categorie_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.categorie
    ADD CONSTRAINT categorie_pkey PRIMARY KEY (id_cat);


--
-- TOC entry 2904 (class 2606 OID 17303)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id_client);


--
-- TOC entry 2910 (class 2606 OID 17335)
-- Name: commande commande_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT commande_pkey PRIMARY KEY (id_commande);


--
-- TOC entry 2914 (class 2606 OID 17365)
-- Name: commentaire commentaire_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT commentaire_pkey PRIMARY KEY (id_commentaire);


--
-- TOC entry 2908 (class 2606 OID 17323)
-- Name: produit produit_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_pkey PRIMARY KEY (id_produit);


--
-- TOC entry 2916 (class 2606 OID 17336)
-- Name: commande fk_commande_id_client; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commande
    ADD CONSTRAINT fk_commande_id_client FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- TOC entry 2917 (class 2606 OID 17366)
-- Name: commentaire fk_commentaire_id_client; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT fk_commentaire_id_client FOREIGN KEY (id_client) REFERENCES public.client(id_client);


--
-- TOC entry 2919 (class 2606 OID 17376)
-- Name: commentaire fk_commentaire_id_commande; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT fk_commentaire_id_commande FOREIGN KEY (id_commande) REFERENCES public.commande(id_commande);


--
-- TOC entry 2918 (class 2606 OID 17371)
-- Name: commentaire fk_commentaire_id_produit; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.commentaire
    ADD CONSTRAINT fk_commentaire_id_produit FOREIGN KEY (id_produit) REFERENCES public.produit(id_produit);


--
-- TOC entry 2915 (class 2606 OID 17324)
-- Name: produit produit_id_cat_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.produit
    ADD CONSTRAINT produit_id_cat_fkey FOREIGN KEY (id_cat) REFERENCES public.categorie(id_cat);


-- Completed on 2021-05-06 10:35:58

--
-- PostgreSQL database dump complete
--

