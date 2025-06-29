CREATE TABLE personagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    genero VARCHAR(20) NOT NULL,
    filiacao VARCHAR(100) NOT NULL,
    recompensa BIGINT NOT NULL,
    origem VARCHAR(50) NOT NULL,
    akuma_no_mi VARCHAR(100) NOT NULL,
    imagem_url TEXT
);