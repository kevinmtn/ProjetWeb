CREATE SEQUENCE public.seq_sans_serial
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9999999999996
    CACHE 1;

ALTER SEQUENCE public.seq_sans_serial
    OWNER TO "BD_KevinMaton";