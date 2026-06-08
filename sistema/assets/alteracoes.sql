ALTER TABLE mercado ADD COLUMN visualizacoes INT NOT NULL DEFAULT 0;

CREATE TABLE receita (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(150) NOT NULL,
    foto VARCHAR(255),
    descricao TEXT NOT NULL
);

CREATE TABLE produto_receita (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    produto_id INT NOT NULL,
    receita_id INT NOT NULL,
    FOREIGN KEY (produto_id) REFERENCES produto(id) ON DELETE CASCADE,
    FOREIGN KEY (receita_id) REFERENCES receita(id) ON DELETE CASCADE
);

CREATE TABLE site_stats (
    pagina VARCHAR(80) PRIMARY KEY,
    visualizacoes INT NOT NULL DEFAULT 0
);
