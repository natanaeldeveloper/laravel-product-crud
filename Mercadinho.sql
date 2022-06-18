create table products (
	id serial not null primary key,
	nome varchar(50) not null,
	descricao varchar(255),
	id_category integer not null,
	created_at timestamp,
	updated_at timestamp
);

alter table products alter column id set default nextval('products_id_seq'::regclass);

create table categories (
	id serial not null primary key,
	nome varchar(50) not null
);

alter table categories alter column id set default nextval('categories_id_seq'::regclass);

alter table products
	add foreign key(id_category)
	references categories(id);
	
alter table products rename id_category to id_categoria;

insert into categories (nome) values  ('ALIMENTO');
insert into categories (nome) values  ('HIGIENE');