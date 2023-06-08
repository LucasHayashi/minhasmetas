CREATE TABLE users (
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
   	email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    created_at DATE DEFAULT NOW(),
    updated_at DATE
)

CREATE TABLE METAS(
	id_meta INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    titulo varchar(500),
    valor_total decimal(15,2),
    valor_inicial decimal(15,2),
    data_limite date,
    data_cadastro DATE DEFAULT NOW(),
    FOREIGN KEY (id_usuario) 
    	REFERENCES users (id_usuario) 
    	ON DELETE CASCADE
);